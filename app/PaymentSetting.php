<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $table = 'paymentsetting';
    public $primaryKey = 'id';
    public $timestamps = true;
}
