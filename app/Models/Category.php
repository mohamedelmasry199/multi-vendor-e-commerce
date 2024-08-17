<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_en', 'name_ar', 'description_en', 'description_ar', 'image', 'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getImageAttribute($value)
    {
        if($value != null)
        {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return $value;
            } else {

                return asset('images/categories/'.$value);
            }
        }
        // else
        // {
        //     return asset('images/categories/logo.png');
        // }
    }
    public function getImgPath($col)
    {
        $value = $this->{$col};
        if($value != null)
        {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return $value;
            } else {

                return asset('images/categories/'.$value);
            }
        }
        else
        {
            return asset('images/logo.png');
        }
    }
}
