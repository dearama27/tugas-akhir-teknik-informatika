<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class Spkb extends CrudGenerator {

    public function initial() {
        $this->setName('Spkb');
        $this->setSearchable('date_delivery');
        $this->addColumn('date_delivery', 'date');
        $this->addColumn('driver_id', 'bigInteger');
        $this->addColumn('ttl_order', 'integer');
        $this->addColumn('ttl_price', 'integer');
        $this->addColumn('ttl_qty', 'integer');
    }

}