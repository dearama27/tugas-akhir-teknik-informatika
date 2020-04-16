<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class Delivery extends CrudGenerator {

    public function initial() {
        $this->setName('Delivery');
        $this->setSearchable('name');
        $this->addColumn('name', 'type');
    }

}