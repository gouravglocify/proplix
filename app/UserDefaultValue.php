<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDefaultValue extends Model
{
    protected $fillable = ['user_id','average_shipping_cost','average_rto_charge','weight_segment','packaging_cost'];
}
