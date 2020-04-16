<?php
namespace App\TrusCRUD\Generator\CRUD;

use App\TrusCRUD\Generator\Crud\Order;
use App\TrusCRUD\Generator\Crud\OrderProduct;
use App\TrusCRUD\Generator\Crud\Product;
use App\TrusCRUD\Generator\Crud\Spkb;
use App\TrusCRUD\Generator\Crud\SpkbOrder;
use App\TrusCRUD\Generator\CrudGenerator;

class CrudBuilder extends CrudGenerator {


    public function run($cmd) {
        $this->cmd = $cmd;


        //Add Mode All Class CRUD Generator
        $this->call(Customer::class);
        $this->call(Order::class);
        $this->call(OrderProduct::class);
        $this->call(Product::class);
        $this->call(Spkb::class);
        $this->call(SpkbOrder::class);
        //.................................
        //Add More
    }

}