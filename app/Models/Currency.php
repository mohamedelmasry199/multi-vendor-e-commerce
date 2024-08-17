<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name_en', 'name_ar', 'dollar_rate', 'is_main'
    ];
}
