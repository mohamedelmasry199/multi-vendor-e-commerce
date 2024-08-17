<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryRequest;
use App\Models\Category;
use App\Traits\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    use Images;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('show_categories');
        $categories = Category::paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('add_categories');
        $categories = Category::paginate(20);
        return view('admin.categories.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('add_categories');
        $data = $request->except(['image']);
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAvatarImage($request->file('image'),'categories');
        }
        Category::create($data);
        return response()->json(['status_code' => 200, 'message' => __('Category created successfully')]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('show_categories');
        $category = Category::findOrFail($id);
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('update_categories');
        $categories=Category::all();
        $category = Category::findOrFail($id);
        return view('admin.categories.form', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('update_categories');
        $category = Category::findOrFail($id);
        $data = $request->except(['image', 'parent_id']);

        if ($request->hasFile('image')) {
            $folder = 'categories';
            $this->deleteOldImage($category->image, $folder);
            $data['image'] = $this->uploadAvatarImage($request->file('image'), $folder);
        }
        if ($request->parent_id && $request->parent_id !== $id) {
            $data['parent_id'] = $request->parent_id;
        }

        $category->update($data);

        return response()->json(['status_code' => 200, 'message' => __('Category updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('delete_categories');
        $category =Category::findOrFail($id);
        $category->delete();
        return response()->json(['status_code' => 200, 'message' => __('Category deleted successfully')]);

    }
    public function exportCSV()
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('show_categories');
        $filename = 'categories-data.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add BOM to fix UTF-8 in Excel
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'name_en', 'name_ar', 'description_en', 'description_ar', 'parent'
            ]);

            Category::chunk(25, function ($categories) use ($handle) {
                foreach ($categories as $category) {
                    $data = [
                        isset($category->name_en) ? $category->name_en : '-',
                        isset($category->name_ar) ? $category->name_ar : '-',
                        isset($category->description_en) ? $category->description_en : '-',
                        isset($category->description_ar) ? $category->description_ar : '-',
                        isset($category->parent->name_ar) ? $category->parent->name_ar : '-',
                    ];
                    fputcsv($handle, $data);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }
    public function getCategories(Request $request)
{
    $request->validate([
        'search' => 'nullable|string|max:255',
        'excludedCategoryId' => 'nullable|integer|exists:categories,id',
    ]);

    $search = $request->input('search');
    $excludedCategoryId = $request->input('excludedCategoryId');

    $categories = Category::query()
        ->when($excludedCategoryId, function ($query) use ($excludedCategoryId) {
            $excludedCategoryIds = Category::where('parent_id', $excludedCategoryId)
                                            ->orWhere('id', $excludedCategoryId)
                                            ->pluck('id');
            $query->whereNotIn('id', $excludedCategoryIds);
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name_ar', 'LIKE', "%{$search}%")
                      ->orWhere('name_en', 'LIKE', "%{$search}%");
            });
        })
        ->get();

    return response()->json($categories);
}

    public function search(Request $request)
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('show_categories');
        $categories = Category::with(['parent']);

        if ($request->keyword != '') {
            $categories = $categories->where(function($query) use ($request) {
                $query->where('name_ar', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('name_en', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('description_ar', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('description_en', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhereHas('parent', function($q) use ($request) {
                        $q->where('name_ar', 'LIKE', '%' . $request->keyword . '%');
                    });
            });
        }
        $categories = $categories->paginate(20);

        return response()->json([
            'categories' => $categories,
            'links' => (string) $categories->links('admin.partials.paginate')
        ]);
    }


    public function filter(Request $request)
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('show_categories');
        $query = Category::query();
        if ($request->has('parent_only')) {
            $query->whereNotNull('parent_id');
        }
        if ($request->has('children_only')) {
            $query->has('children');
        }

        $categories = $query->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }
}
