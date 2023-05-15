<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offer';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $appends = ['imagePath'];
    
    public function getImagePathAttribute()
    {
        return url('storage/images/offer') . '/';
    }
}
