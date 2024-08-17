<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ItemRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Print_;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    use Images;
    public function __construct()
    {
        $this->middleware('check_permission:show_items')->only([ 'show', 'index','filter', 'exportCSV', 'search','getChildren','active']);
        $this->middleware('check_permission:add_items')->only(['create', 'store','getChildren']);
        $this->middleware('check_permission:update_items')->only(['edit', 'update','getChildren']);
        $this->middleware('check_permission:delete_items')->only(['destroy']);
    }

    public function index()
    {
        // $items = Product::paginate(20);
        $items = Product::withTrashed()->paginate(20);
        return view('admin.items.index', compact('items'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.items.form', compact('categories'));
    }
    public function store(ItemRequest $request)
    {
        $image = null;
        $images = [];
        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $this->uploadAvatarImage($image,'items');
                $images[] = $path;
            }
        }
        if($request->hasFile('main_image')) {
            $path = $this->uploadAvatarImage($request->file('main_image'), 'items');
            $image = $path;
        }
        $item = new Product();
        $item->name_en = $request->name_en;
        $item->name_ar = $request->name_ar;
        $item->main_image = $image;
        $item->images = $images;
        $item->description_en = $request->description_en;
        $item->description_ar = $request->description_ar;
        $item->price_before_offer = $request->price_before_offer;
        $item->price_after_offer = $request->price_after_offer;
        $item->category_id = $request->category_id;
        $item->save();
        return response()->json(['status_code' => 200, 'message' => __('Item created successfully')]);
    }
    public function edit(string $id)
    {
        $item = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.items.form', compact('item', 'categories'));
    }
    public function show(string $id)
    {
        $item = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.items.form', compact('item', 'categories'));
    }
    public function update(ItemRequest $request, $id)
    {
        $item = Product::findOrFail($id);
        if ($request->hasFile('main_image')) {
            $mainImagePath = $this->uploadAvatarImage($request->file('main_image'), 'items');
            $item->main_image = $mainImagePath;
        }
        $newImages = [];
        if ($request->hasFile('images')) {
            $newImages = $this->uploadMultipleImages($request->file('images'), 'items');
        }
        $existingImages = array_map(function($image) {
            return basename($image);
        }, $request->input('existing_images', []));
        $deletedImages = $request->input('deleted_images', []);
        $allImages = array_merge($existingImages, $newImages);
        $item->images = $allImages;
        $item->name_en = $request->name_en;
        $item->name_ar = $request->name_ar;
        $item->description_en = $request->description_en;
        $item->description_ar = $request->description_ar;
        $item->price_before_offer = $request->price_before_offer;
        $item->price_after_offer = $request->price_after_offer;
        $item->category_id = $request->category_id;
        $item->save();
        $this->deleteImages($deletedImages);
        return response()->json(['status_code' => 200, 'message' => __('Item updated successfully')]);
    }


        public function getChildren($id)
        {
            $children = Category::where('parent_id', $id)->get();
            return response()->json($children);
        }
        public function destroy(string $id)
        {
            $item = Product::findOrFail($id);
            $item->delete();

            return response()->json(['status_code' => 200, 'message' => __('item deleted successfully')]);
        }
        public function active(Request $request)
        {
            $id = $request->id;
            $item = Product::withTrashed()->findOrFail($id);
            $value = $request->value;

            if ($value == "active") {
                $item->restore();
                $message = __('Enable Activation Successfully');
            } else {
                $item->delete();
                $message = __('Disable Activation Successfully');
            }

            $arr = array('status' => 'success', 'message' => $message, 'data' => [], 'status_code' => 200);
            return response()->json($arr);
        }



         public function filter(Request $request)
        {
            $rules = [
                'offers_filter' => 'nullable|in:on',
                'no_offers_filter' => 'nullable|in:on',
                'deleted_filter' => 'nullable|in:on',
                'not_deleted_filter' => 'nullable|in:on',
                'price_filter' => 'nullable|in:equal,greater,less',
                'price_value' => 'nullable|numeric|min:0',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
             $query = Product::withTrashed();
            if ($request->has('offers_filter')) {
                $query->whereNotNull('price_after_offer');
            }
            if ($request->has('no_offers_filter')) {
                $query->whereNull('price_after_offer');
            }
            if ($request->has('deleted_filter')) {
                $query->whereNotNull('deleted_at');
            }
            if ($request->has('not_deleted_filter')) {
                $query->whereNull('deleted_at');
            }
            $priceFilter = $request->input('price_filter');
            $priceValue = $request->input('price_value');

            if ($priceFilter && $priceValue !== null) {
                $priceValue = (float) $priceValue;

                switch ($priceFilter) {
                    case 'equal':
                        $query->where('price_before_offer', '=', $priceValue);
                        break;
                    case 'greater':
                        $query->where('price_before_offer', '>=', $priceValue);
                        break;
                    case 'less':
                        $query->where('price_before_offer', '<', $priceValue);
                        break;
                }
            }
            $items = $query->paginate(20);

            return view('admin.items.index', compact('items'));
        }
        public function search(Request $request)
        {
            $items = Product::with(['category'])->withTrashed();

            if ($request->keyword != '') {
                $items = $items->where(function($query) use ($request) {
                    $query->where('name_ar', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('name_en', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('description_ar', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('description_en', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('price_before_offer', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('price_after_offer', 'LIKE', '%' . $request->keyword . '%');
                        })->orWhereHas('category', function($q) use ($request) {
                        $q->where('name_ar', 'LIKE', '%' . $request->keyword . '%');
                    });
            }

            $items = $items->paginate(20);

            foreach ($items as $item) {
                $item->main_image_path = $item->getImgPath('main_image');
            }

            return response()->json([
                'items' => $items,
                'links' => (string) $items->links('admin.partials.paginate')
            ]);
        }

        public function exportCSV()
        {
            $filename = 'items-data.csv';

            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0',
            ];

            return response()->stream(function () {
                $handle = fopen('php://output', 'w');

                fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

                fputcsv($handle, [
                    'name_en', 'name_ar', 'description_en', 'description_ar', 'price_before_offer', 'price_after_offer','category_en','category_ar'
                ]);

                Product::chunk(25, function ($items) use ($handle) {
                    foreach ($items as $item) {
                        $data = [
                            isset($item->name_en) ? $item->name_en : '-',
                            isset($item->name_ar) ? $item->name_ar : '-',
                            isset($item->description_en) ? $item->description_en : '-',
                            isset($item->description_ar) ? $item->description_ar : '-',
                            isset($item->price_before_offer) ? $item->price_before_offer : '-',
                            isset($item->price_after_offer) ? $item->price_after_offer : '-',
                            isset($item->category->name_en) ? $item->category->name_en : '-',
                            isset($item->category->name_ar) ? $item->category->name_ar : '-'
                        ];
                        fputcsv($handle, $data);
                    }
                });

                fclose($handle);
            }, 200, $headers);
}

}
