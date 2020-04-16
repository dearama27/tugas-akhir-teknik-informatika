<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpkbOrder extends Model
{

    function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
