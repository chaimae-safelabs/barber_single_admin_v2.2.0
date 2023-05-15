<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification'; 
    public $primaryKey = 'id';
    public $timestamps = true;
}
