<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    public $primaryKey = 'address_id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
