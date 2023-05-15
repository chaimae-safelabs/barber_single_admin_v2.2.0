<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';
    public $primaryKey = 'id';
    public $timestamps = true;

}
