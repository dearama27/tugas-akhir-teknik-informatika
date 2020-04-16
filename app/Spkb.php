<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spkb extends Model
{
    

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
