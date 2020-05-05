<?php

use App\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $load_json    = file_get_contents(__DIR__ . '/sources/data_custumer.json');
        $toArray      = json_decode($load_json);

        $no           = 1;
        
        foreach($toArray->data as $cust) {

            Customer::create([
                'customer_code' => 'MBS-C'.str_pad($no, 4, "0", STR_PAD_LEFT),
                'name'    => $cust->name,
                'address' => $cust->address,
                'lat'     => $cust->lat,
                'lng'     => $cust->lng,
                'mobile_phone' => substr($cust->mobile_phone,0,9).'999',
                'distribution_center_id' => rand(1,5),
                'join_at' => gmdate('Y-m-d', time()+60*60*7),
            ]);
            // if($no <= 10) {
            // } else {
            // break;
            // }
            $no++;
        }
    }
}
