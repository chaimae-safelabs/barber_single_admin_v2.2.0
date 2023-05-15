<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    public $primaryKey = 'emp_id';
    public $timestamps = true;

    public $appends = ['imagePath'];


    public function getImagePathAttribute()
    {
        return url('storage/images/employee') . '/';
    }

    public function getServicesAttribute()
    {
        $var = json_decode($this->service_id, true);
        return Service::whereIn('service_id',$var)->get();
    }
    
    public function getSalonAttribute()
    {
        $salon = Salon::find($this->attributes['salon_id']);
        return $salon;
    }

    public function salon()
    {
        return $this->belongsTo('App\Salon');
    }
    public function booking()
    {
        return $this->belongsTo('App\Booking','booking_id','id');
    }
    public function service()
    {
        return $this->hasOne('App\Service','service_id','service_id');
    }
}
