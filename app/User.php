<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    protected $appends = ['imagePath'];

    protected $fillable = [
        'name', 'email', 'password','phone','status','verify','otp','role','code',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function review()
    {
        return $this->hasMany('App\Review');
    }
    public function address()
    {
        return $this->hasMany('App\Address');
    }
    public function booking()
    {
        return $this->hasMany('App\Booking');
    }
    public function getImagePathAttribute()
    {
        return url('storage/images/users') . '/';
    }
}