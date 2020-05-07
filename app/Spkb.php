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

    function total_actual($detailArray) {
        $qty = 0;
        $price = 0;
        foreach($detailArray as $spkb) {
            $qty    += $spkb->order->ttl_actual_qty;
            $price  += $spkb->order->ttl_actual_total;
        }

        return [
            "qty" => $qty,
            "price" => $price,
        ];
    }

    function status($detailArray) {
        $terkirim = count(array_filter($detailArray, function($x) {
            return $x['delivery_status'] == 1;
        }));

        $batal = count(array_filter($detailArray, function($x) {
            return $x['delivery_status'] == 2;
        }));

        $belum = count(array_filter($detailArray, function($x) {
            return $x['delivery_status'] < 1;
        }));

        return [
            'terkirim' => $terkirim,
            'batal' => $batal,
            'belum' => $belum,
        ];
    }

    function user_driver() {
        return $this->belongsTo(User::class, 'driver_id');
    }

    function dc() {
        return $this->belongsTo(DistributionCenter::class, 'pic_id');
    }

}
