<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name_en', 'name_ar', 'flag', 'code'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function getImgPath($col)
    {
        $value = $this->{$col};
        if($value != null)
        {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return $value;
            } else {

                return asset('images/flags/'.$value);
            }
        }
        // else
        // {
        //     return asset('images/logo.png');
        // }
    }
}
