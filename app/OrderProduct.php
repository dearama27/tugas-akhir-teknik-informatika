<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        "order_id",
        "product_id",
        "price",
        "qty",
        "total",
        "actual_qty",
        "actual_total",
    ];
    
    function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
