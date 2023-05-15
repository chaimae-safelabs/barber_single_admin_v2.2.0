<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    public $primaryKey = 'gallery_id';
    public $timestamps = true;
    protected $appends = ['imagePath'];
    public function salon()
    {
        return $this->belongsTo('App\Salon');
    }
    public function getImagePathAttribute()
    {
        return url('storage/images/gallery') . '/';
    }
}
