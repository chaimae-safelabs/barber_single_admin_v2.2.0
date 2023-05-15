<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $appends = ['imagePath'];
    
    public function getImagePathAttribute()
    {
        return url('storage/images/banner') . '/';
    }
}
