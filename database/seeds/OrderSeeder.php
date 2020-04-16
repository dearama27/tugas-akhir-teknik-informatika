<?php

use App\Order;
use App\OrderProduct;
use App\Product;
use App\Spkb;
use App\SpkbOrder;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Order::create([
        //     "date_delivery" => gmdate('Y-m-d', time()+60*60*7),
        //     "ttl_price" => 58800*10,
        //     "ttl_qty" => 10,
        //     "customer_id" => 1
        // ]);

        // OrderProduct::create([
        //     "product_id" => 1,
        //     "price" => 58800,
        //     "qty" => 10,
        //     "order_id" => 1
        // ]);


        $data = [
            [
                'id' => rand(1,5),
                'qty' => rand(5,10)
            ],
            [
                'id' => rand(1,5),
                'qty' => rand(5,10)
            ],
            [
                'id' => rand(1,5),
                'qty' => rand(5,10)
            ],
            [
                'id' => rand(1,5),
                'qty' => rand(5,10)
            ],
            [
                'id' => rand(1,5),
                'qty' => rand(5,10)
            ],
        ];


        foreach($data as $key => $val) {

            $product = Product::where('id', $val['id'])->first();
            //2
            Order::create([
                "date_delivery" => gmdate('Y-m-d', time()+60*60*7),
                "ttl_price" => $product->harga*5,
                "ttl_qty" => $val['qty'],
                "customer_id" => rand(1,6)
            ]);
    
            OrderProduct::create([
                "product_id" => $val['id'],
                "price" => $product->harga,
                "qty" => $val['qty'],
                "order_id" => $key+1,
                "total" => $product->harga*$val['qty']
            ]);

        }


    }
}
