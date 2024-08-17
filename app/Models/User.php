<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email','email_verified_at', 'password', 'phone', 'country_id', 'city_id', 'address', 'image','status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function getImageAttribute($value)
    {
        if($value != null)
        {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return $value;
            } else {

                return asset('images/users/'.$value);
            }
        }
        // else
        // {
        //     return asset('images/users/logo.png');
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

                    return asset('images/users/'.$value);

            }
        }
        else
        {
            return asset('images/logo.png');
        }
    }

}
