<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';
    public $primaryKey = 'id';
    public $timestamps = true;
}
