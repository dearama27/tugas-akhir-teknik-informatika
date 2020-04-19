<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'related_spkb'
    ];
    
    //Related Customer
    function customer() {
        return $this->belongsTo(\App\Customer::class, 'customer_id');
    }

    function detail() {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

}
