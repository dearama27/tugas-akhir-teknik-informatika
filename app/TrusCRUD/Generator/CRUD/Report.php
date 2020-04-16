<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class Report extends CrudGenerator {

    public function initial() {
        $this->setName('Report');
        $this->setSearchable('name');
        $this->addColumn('name', 'type');
    }

}