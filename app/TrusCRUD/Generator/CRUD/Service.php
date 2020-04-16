<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class Service extends CrudGenerator {

    public function initial() {
        $this->setName('Service');
        $this->setSearchable('name');
        $this->addColumn('name', 'string');
        $this->addColumn('description', 'text');
    }

}