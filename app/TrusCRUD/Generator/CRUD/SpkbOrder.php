<?php
namespace App\TrusCRUD\Generator\Crud;

use App\TrusCRUD\Generator\CrudGenerator;

class SpkbOrder extends CrudGenerator {

    public function initial() {
        $this->setName('SpkbOrder');
        $this->setGenerateMenu(false);
        $this->addColumn('order_id', 'bigInteger');
    }

}