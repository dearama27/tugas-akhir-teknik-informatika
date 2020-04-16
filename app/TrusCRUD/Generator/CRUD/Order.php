<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class Order extends CrudGenerator {

    public function initial() {
        $this->setName('Order');
        $this->setSearchable('date_delivery');
        $this->addColumn('date_delivery', 'date');
        $this->addColumn('ttl_price', 'integer');
        $this->addColumn('ttl_qty', 'integer');
        $this->addColumn('customer_id', 'bigInteger')->relation('belongsTo', 'Customer');
    }

}