<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Report extends Model
{

	protected $table = 'reports';

    protected $fillable = ['title', 'sellingprice', 'productcost', 'orders','cancel','roas','delivery','salevalue','dispatchOrderValue','cpp','delivered','profitperdelivered','totalprofit','remittance','adcost','product','gst','packaging','shipping','totalexpense', 'shippingcost', 'rtocharge', 'weightsegment', 'gstpercentage', 'user_id','profitPerOrder'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}