<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CountryRequest;
use App\Models\Country;
use App\Traits\Images;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use Images;

    public function __construct()
    {
        $this->middleware('check_permission:show_countries')->only([ 'show', 'index','filter', 'exportCSV', 'search']);
        $this->middleware('check_permission:add_countries')->only(['create', 'store']);
        $this->middleware('check_permission:update_countries')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_countries')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries=Country::paginate(20);
        return view('admin.countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $data = $request->except('flag');

        if ($request->hasFile('flag')) {
            $folder = 'flags';
            $data['flag'] = $this->uploadAvatarImage($request->file('flag'), $folder);
        }
        Country::create($data);
        return response()->json(['status_code' => 200, 'message' => __('Country created successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country=Country::findOrFail($id);
        return view('admin.countries.form',compact('country'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country=Country::findOrFail($id);
        return view('admin.countries.form',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        $country=Country::findOrFail($id);
        $data = $request->except('flag');

        if ($request->hasFile('flag')) {
            $folder = 'flags';
            $this->deleteOldImage($country->flag, $folder);
            $data['flag'] = $this->uploadAvatarImage($request->file('flag'), $folder);
        }
        $country->update($data);
        return response()->json(['status_code' => 200, 'message' => __('Country updated successfully')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country=Country::findOrFail($id);
        $this->deleteOldImage($country->flag, 'flags');
        $country->delete();
        return response()->json(['status_code' => 200, 'message' => __('Country deleted successfully')]);
    }
    public function exportCSV()
    {
        $filename = 'countries-data.csv';

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
                'name_en', 'name_ar', 'code'
            ]);

            Country::chunk(25, function ($countries) use ($handle) {
                foreach ($countries as $country) {
                    $data = [
                        isset($country->name_en) ? $country->name_en : '-',
                        isset($country->name_ar) ? $country->name_ar : '-',
                        isset($country->code) ? $country->code : '-',
                    ];
                    fputcsv($handle, $data);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    public function search(Request $request)
    {
        $countries = Country::query();

        if ($request->keyword != '') {
            $countries = $countries->where(function($query) use ($request) {
                $query->where('name_ar', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('name_en', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('code', 'LIKE', '%' . $request->keyword . '%');
        });
        }
        $countries = $countries->paginate(20);
        foreach ($countries as $country) {
            $country->flag_path = $country->getImgPath('flag');
        }
        return response()->json([
            'countries' => $countries,
            'links' => (string) $countries->links('admin.partials.paginate')
        ]);
    }

}
