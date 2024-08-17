<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $fillable = [
        'title_en', 'title_ar', 'content_en', 'content_ar'
    ];
}
