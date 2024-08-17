<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CityRequest;
use App\Models\City;
use App\Models\Country;
use App\Traits\Images;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use Images;
    public function __construct()
    {
        $this->middleware('check_permission:show_cities')->only([ 'show', 'index','filter', 'exportCSV', 'search']);
        $this->middleware('check_permission:add_cities')->only(['create', 'store']);
        $this->middleware('check_permission:update_cities')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_cities')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities=City::paginate(20);
        $countries=Country::all();
        return view('admin.cities.index',compact('cities','countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries=Country::all();
        return view('admin.cities.form',compact('countries'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        City::create($request->validated());
        return response()->json(['status_code' => 200, 'message' => __('City created successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city=City::findOrFail($id);
        return view('admin.cities.form',compact('city'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city=City::findOrFail($id);
        $countries=Country::all();
        return view('admin.cities.form',compact('city','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
        $city=City::findOrFail($id);
        $city->update($request->validated());
        return response()->json(['status_code' => 200, 'message' => __('City updated successfully')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city=City::findOrFail($id);
        $city->delete();
        return response()->json(['status_code' => 200, 'message' => __('City deleted successfully')]);
    }
    public function exportCSV()
    {
        $filename = 'cities-data.csv';

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
                'name_en', 'name_ar', 'country'
            ]);

            City::chunk(25, function ($cities) use ($handle) {
                foreach ($cities as $city) {
                    $data = [
                        isset($city->name_en) ? $city->name_en : '-',
                        isset($city->name_ar) ? $city->name_ar : '-',
                        isset($city->country->name_ar) ? $city->country->name_ar : '-',
                    ];
                    fputcsv($handle, $data);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    public function search(Request $request)
    {
        $cities = City::with('country');

        if ($request->keyword != '') {
            $cities = $cities->where(function($query) use ($request) {
                $query->where('name_ar', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('name_en', 'LIKE', '%' . $request->keyword . '%');
        });
        }
        $cities = $cities->paginate(20);

        return response()->json([
            'cities' => $cities,
            'links' => (string) $cities->links('admin.partials.paginate')
        ]);
    }
    public function filter(Request $request)
    {
        $countries = Country::all();
        $countryId = $request->input('country');
        $cities = City::query()
            ->when($countryId, function ($query, $countryId) {
                return $query->where('country_id', $countryId);
            })->paginate(20);

        return view('admin.cities.index', compact('cities', 'countries'));
    }

}
