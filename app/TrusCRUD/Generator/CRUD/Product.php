<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class Product extends CrudGenerator {

    public function initial() {
        $this->setName('Product');
        $this->setSearchable('name');
        $this->addColumn('name', 'string');
        $this->addColumn('harga', 'integer');
        // $this->addColumn('customer_id', 'bigInteger')->relation('belongsTo', 'Customer');
    }

}