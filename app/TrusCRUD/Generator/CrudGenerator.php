<?php
namespace App\TrusCRUD\Generator;

use App\TrusCRUD\Core\Models\Generator as GModel;
use App\TrusCRUD\Generator\CrudGeneratorView;

/**
 * Class CrudGenerator
 * First Class Running on Generate a CRUD
 */
class CrudGenerator {

    use CrudGeneratorView;
    use CrudGeneratorCore;

    public $cmd;

    public function __construct() {

    }

    public function build($cmd) {
        $this->name_underscore = $this->from_camel_case($this->name);
        $this->saveConfigToDb();
        $this->controller($cmd);
        $this->model_migration($cmd);
        
        if($this->generate_menu) {
            $this->add_route();
            $this->initView();
            $this->add_menu();
        }

    }

    public function call($class) {
        $runClass = (new $class);
        $runClass->initial();

        $this->cmd->info("\nCrud Generator : <bold>$runClass->name</bold>");
        $runClass->build($this->cmd);
        $this->cmd->line('----------------------------------------------------');
    }

    function saveConfigToDb() {
        $tcGenerator = new GModel();

        $config              = [
            "columns"           => $this->columns,
            "underscore_name"   => $this->name_underscore,
            "camel_case_name"   => $this->name,
        ];

        $tcGenerator->name          = $this->name;
        $tcGenerator->config        = serialize($config);
        $tcGenerator->status        = true;
        $tcGenerator->generate_from = 'Command Line Interface';
        $tcGenerator->healthy       = 0;
        $tcGenerator->generated_at  = gmdate('Y-M-d H:i:s', time()+60*60*7);

        $tcGenerator->save();
    }

}