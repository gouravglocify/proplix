<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $fillable = ['user_id','plan_type','subscription_id','plan_id','customer_id','payment_id','signature','short_url','status','charge_at','start_at','end_at','current_end','coupon_id','discount_amount','discount_price','total_count','remaining_count'];


    public function getUserDetails(){
    	return $this->hasOne('App\User','id','user_id');
    }
}
