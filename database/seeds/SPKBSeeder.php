<?php

use App\Order;
use App\Spkb;
use App\SpkbOrder;
use Illuminate\Database\Seeder;

class SPKBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Spkb::create([
        //     "code"          => 'AA'.gmdate('dmy', time()+60*60*7).str_pad('1', 4, '0', STR_PAD_LEFT),
        //     "date_delivery" => gmdate('Y-m-d', time()+60*60*7),
        //     "pic_id"     => 4,
        //     "driver_id"     => 4,
        //     "ttl_order"     => 1,
        //     "ttl_price"     => 58800*10,
        //     "ttl_qty"       => 10,
        // ]);

        // SpkbOrder::create([
        //     'spkb_id' => 1,
        //     'order_id' => 1
        // ]);


        // $data = [
        //     [
        //         'order_id' => rand(1,5),
        //         'pic_id' => rand(1,5),
        //     ],
        //     [
        //         'order_id' => rand(1,5),
        //         'pic_id' => rand(1,5),
        //     ],
        //     [
        //         'order_id' => rand(1,5),
        //         'pic_id' => rand(1,5),
        //     ],
        //     [
        //         'order_id' => rand(1,5),
        //         'pic_id' => rand(1,5),
        //     ],
        //     [
        //         'order_id' => rand(1,5),
        //         'pic_id' => rand(1,5),
        //     ],
        // ];

        // foreach($data as $key=>$val) {

        //     $order = Order::where('id', $val['order_id'])->first();

        //     Spkb::create([
        //         "code"              => $order->customer->dc->dc_code.gmdate('dmy', time()+60*60*7).str_pad('1', 4, '0', STR_PAD_LEFT),
        //         "date_delivery"     => gmdate('Y-m-d', time()+60*60*7),
        //         "pic_id"            => $val['pic_id'],
        //         "driver_id"         => 4,
        //         "ttl_order"         => 1,
        //         "ttl_price"         => $order->ttl_price,
        //         "ttl_qty"           => $order->ttl_qty,
        //     ]);
    
        //     SpkbOrder::create([
        //         'spkb_id' => $key+1,
        //         'order_id' => $order->id
        //     ]);
        // }
    }
}
