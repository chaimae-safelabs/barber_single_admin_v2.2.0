<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table = 'salon';
    public $primaryKey = 'salon_id';
    public $timestamps = true;

    public $appends = ['rate','imagePath'];
    public function getRateAttribute()
    {
        $review =  Review::where('salon_id', $this->attributes['salon_id'])->get(['rate']);
        if(count($review)>0)
        {
            $totalRate = 0;
            foreach ($review as $r)
            {
                $totalRate=$totalRate+$r->rate;
            }
            return number_format($totalRate / count($review),1);
        }else{
            return 0;
        } 
    }
    public function getImagePathAttribute()
    {
        return url('storage/images/salon%20logos') . '/';
    }
    
    public function service()
    {
        return $this->hasMany('App\Service');
    }
    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }
    public function employee()
    {
        return $this->hasMany('App\Employee');
    }
    public function booking()
    {
        return $this->hasMany('App\Booking');
    }
    public function coupon()
    {
        return $this->hasMany('App\Coupon');
    }
    public function review()
    {
        return $this->hasMany('App\Review');
    }
}
