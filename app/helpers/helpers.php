<?php
use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

function getCountryName($id){
    $country=Country::where('id',$id)->first();
    $name = $country->name_ar;
    return $name;
}
function permission($permission){
    return Auth::guard('admin')->user()->hasAnyPermission($permission)? true : false;
}
