<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
//     public function autocompleteCity(Request $request)
//     {
//         $search = $request->search;
//         if ($search == "") {
//             $autocomplate = City::orderBy("id","DESC")->limit(20)->groupBy('id')->orderBy('id', 'DESC')->get();
//         }else {
//             $autocomplate = City::whereRaw("( name_ar like '%" . $search . "%'  or  name_en like '%" . $search . "%'  )")->limit(20)->groupBy('id')->orderBy('id', 'DESC')->get();
//         }

//         $response = array();
//         foreach ($autocomplate as $autocomplate) {
//             $response[] = array("value" => $autocomplate->id, "label" => $autocomplate->name_ar);
//         }

//         echo  json_encode($response);
//         exit;
// }
public function autoCompleteCountry(Request $request)
{
    $search = $request->search;

    $countries = Country::select('id', 'name_en', 'name_ar')
                        ->where('name_en', 'LIKE', "%{$search}%")
                        ->orWhere('name_ar', 'LIKE', "%{$search}%")
                        ->limit(20)
                        ->get();

    $response = array();
    foreach ($countries as $country) {
        $response[] = array(
            "value" => $country->id,
            "label" => $country->name_en . ' - ' . $country->name_ar
        );
    }

    return response()->json($response);
}
public function autocomplete(Request $request)
{
    $search = $request->search;

    $countries = Country::select('id', 'name_en', 'name_ar')
                        ->where('name_en', 'LIKE', "%{$search}%")
                        ->orWhere('name_ar', 'LIKE', "%{$search}%")
                        ->limit(20)
                        ->get();

    $response = array();
    foreach ($countries as $country) {
        $response[] = array(
            "value" => $country->id,
            "label" => $country->name_en . ' - ' . $country->name_ar
        );
    }

    return response()->json($response);
}
public function getCities(Request $request)
{
    $request->validate([
        'country_id' => 'required|exists:countries,id',
    ]);

    $countryId = $request->input('country_id');
    $cities = City::where('country_id', $countryId)->pluck('name_ar', 'id');

    return response()->json($cities);
}
public function autocompleteCity(Request $request)
    {
        $search = $request->input('search');

        $cities = City::where('name', 'LIKE', "%{$search}%")
                      ->get(['id', 'name as label']); // Adjust columns as needed

        return response()->json($cities);
    }
}


