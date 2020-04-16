<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    

    function dc() {
        return $this->belongsTo(DistributionCenter::class, 'distribution_center_id');
    }
}
