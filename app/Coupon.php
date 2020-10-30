<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon_applicable_on','name','description','discount_type','discount_value','duration','number_of_use','end_date','status'];
}
