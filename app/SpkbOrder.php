<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpkbOrder extends Model
{

    protected $fillable = [
        'spkb_id',
        'order_id',
    ];

    function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
