<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_en', 'name_ar', 'main_image', 'images', 'description_en', 'description_ar', 'category_id', 'price_before_offer', 'price_after_offer'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getImageAttribute($value)
    {
        if($value != null)
        {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return $value;
            } else {
                return asset('images/items/'.$value);
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

                return asset('images/items/'.$value);
            }
        }
        // else
        // {
        //     return asset('images/logo.png');
        // }
    }
    public function getImgPaths($col=null)
{
    $value = $this->{$col};

    if ($value !== null) {
        if (is_array($value)) {
            $imagePaths = [];
            foreach ($value as $image) {
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    $imagePaths[] = $image;
                } else {
                    $imagePaths[] = asset('images/items/'.$image);
                }
            }
            return $imagePaths;
        } elseif (filter_var($value, FILTER_VALIDATE_URL)) {
            return [$value];
        } else {
            return [asset('images/items/'.$value)];
        }
    }

    return [];
}
// public function images($param = null)
// {
//     $product = Product::find($this->id);
//     if (!$product) {
//         return null;
//     }

//     $images = $product->images;
//     $slider = [];

//     foreach ($images as $img) {
//         $image = $img;
//         if ($param) {
//             $image = explode('350x200', $image);
//             if (count($image) == 2) {
//                 $image = $image[0] . $param . $image[1];
//             } else {
//                 $image = $param . '_' . str_replace('/', '', str_replace('ratio60_', '', str_replace('original_', '', str_replace(url('images/items/'), '', $img))));
//                 if (!File::exists(public_path(env('images_path') . '/items/' . $image))) {
//                     $image = str_replace('/', '', str_replace('ratio60_', '', str_replace('original_', '', str_replace(url('images/items/'), '', $img))));
//                 }
//             }
//         }

//         if (filter_var($image, FILTER_VALIDATE_URL)) {
//             $slider[] = $image;
//         } else {
//             $slider[] = asset('images/items/' . $image);
//         }
//     }

//     return $slider;
// }

 }
