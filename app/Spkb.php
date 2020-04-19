<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spkb extends Model
{
    
    protected $fillable = [
        "code",
        "date_delivery",
        "driver_id",
        "pic_id",
        "ttl_order",
        "ttl_price",
        "ttl_qty",
    ];

    function detail() {
        return $this->hasMany(SpkbOrder::class, 'spkb_id');
    }

    function user_driver() {
        return $this->belongsTo(User::class, 'driver_id');
    }

    function dc() {
        return $this->belongsTo(DistributionCenter::class, 'pic_id');
    }

}
