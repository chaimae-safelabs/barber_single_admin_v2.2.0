<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    protected $table = 'adminsetting';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $appends = ['imagePath'];

    public function getImagePathAttribute()
    {
        return url('storage/images/app') . '/';
    }
}
