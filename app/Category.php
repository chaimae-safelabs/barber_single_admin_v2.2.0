<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public $primaryKey = 'cat_id';
    public $timestamps = true;
    protected $appends = ['imagePath'];

    public function service()
    {
        return $this->hasMany('App\Service');
    }
    public function getImagePathAttribute()
    {
        return url('storage/images/categories') . '/';
    }
}
