<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $table = 'service';

    public $primaryKey = 'service_id';
    
    public $timestamps = true;

    protected $appends = ['imagePath'];

    public function category()
    {
        return $this->hasOne('App\Category', 'cat_id', 'cat_id');
    }
    public function salon()
    {
        return $this->belongsTo('App\Salon');
    }
    public function getImagePathAttribute()
    {
        return url('storage/images/services') . '/';
    }
    public function employee()
    {
        return $this->hasMany('App\Employee');
    }
    public function booking()
    {
        return $this->hasMany('App\Booking');
    }
}
