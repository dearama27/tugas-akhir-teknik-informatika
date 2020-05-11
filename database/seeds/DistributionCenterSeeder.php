<?php

use App\DistributionCenter;
use Illuminate\Database\Seeder;

class DistributionCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $load_json    = file_get_contents(__DIR__ . '/sources/data_dc.json');
        $toArray      = json_decode($load_json);

        $no           = 1;
        
        foreach($toArray as $dc) {

            if(preg_match("/RUTE/", $dc->text)) {
                DistributionCenter::create([
                    'dc_code'   => $dc->dc_code,
                    'name'      => $dc->text,
                ]);
            }
            
            $no++;
        }
    }
}
