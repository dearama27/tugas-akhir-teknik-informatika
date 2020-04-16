<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make CRUD Scaffolder';
    protected $location    = 'TrusCRUD/Generator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
    */
    public function handle() {
        //Show Banner
        $this->banner();

        $name  = $this->argument('name');

        if($name == 'banner') {
            $this->banner();
            die;
        }

        $stub     = file_get_contents(app_path($this->location.'/Stubs/Crud.stub'));
        $multiple = explode(',', $name);

        if(count($multiple) > 1) {
            foreach($multiple as $className) {
                $table = strtolower(Str::plural(Str::camel($className)));
                $stub  = str_replace(["{{name}}","{{table}}"], [$className, $table], $stub);
        
                $this->makeCrud($className, $stub);
                $this->line("-----------------------------------------------");
            }
        } else {
            $table = strtolower(Str::plural(Str::camel($name)));
            $stub  = str_replace(["{{name}}","{{table}}"], [$name, $table], $stub);
    
            $this->makeCrud($name, $stub);
        }
    }

    public function makeCrud($name, $stub) {
        // $name = gmdate('Y_m_d_His_').$name.".php";
        $name = $name.".php";
        $path = app_path($this->location.'/CRUD/'.$name);

        try {
            if(file_exists($path)) {
                $this->info("\nCRUD with name <bold>'$name'</bold> already exists");
                $this->line("$path\n");
                die;
            }
            file_put_contents($path, $stub);
            $this->info("CRUD Generator created: <bold>".$name."</bold>");
            $this->line("$path\n");

        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            die;
        }
    }

    function banner() {
        $style = new OutputFormatterStyle('green', 'default', ['bold']);
        $this->output->getFormatter()->setStyle('bold', $style);

        $version = app()->version();
        $this->line("
     _____                ____ ____  _   _ ____  
    |_   _| __ _   _ ___ / ___|  _ \| | | |  _ \   | CLI - Crud Builder <bold>V1.0</bold>
      | || '__| | | / __| |   | |_) | | | | | | |  | Laravel $version
      | || |  | |_| \__ \ |___|  _ <| |_| | |_| |  |
      |_||_|   \__,_|___/\____|_| \_\\\___/|____/   | www.dani.work\n");
    }
}
