<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProducteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $load_json    = file_get_contents(__DIR__ . '/sources/data_produk.json');
        $toArray      = json_decode($load_json);


        $no = 1;
        foreach($toArray as $product) {
            if(preg_match("/AICE/", $product->text) && $no <= 15) {

                Product::create([
                    'name' => $product->text,
                    'harga' => $product->price,
                ]);
                $no++;
            }
        }
    }
}
