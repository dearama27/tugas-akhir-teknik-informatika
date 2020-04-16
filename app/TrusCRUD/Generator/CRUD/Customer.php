<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class Customer extends CrudGenerator {

    public function initial() {
        $this->setName('Customer');
        $this->setSearchable('name');
        $this->addColumn('name',  'string');
        $this->addColumn('address',  'string');
        $this->addColumn('customer_code', 'string');
        $this->addColumn('mobile_phone', 'string');
        $this->addColumn('lat', 'string');
        $this->addColumn('lng', 'string');
        $this->addColumn('join_at', 'date');
    }

}