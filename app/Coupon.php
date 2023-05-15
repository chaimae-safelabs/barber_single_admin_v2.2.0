<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    public $primaryKey = 'coupon_id';
    public $timestamps = true;

    public function salon()
    {
        return $this->belongsTo('App\Salon');
    }
}
