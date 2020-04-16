<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class OrderProduct extends CrudGenerator {

    public function initial() {
        $this->setName('OrderProduct');
        $this->setGenerateMenu(false);
        $this->addColumn('product_id', 'bigInteger');
        $this->addColumn('price', 'bigInteger');
        $this->addColumn('qty', 'bigInteger');
    }

}