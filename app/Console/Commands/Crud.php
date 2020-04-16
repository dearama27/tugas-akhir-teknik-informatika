<?php

namespace App\Console\Commands;

use App\TrusCRUD\Generator\CRUD\CrudBuilder;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use App\Console\BaseCommand;
class Crud extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {--class=} {--migrate} {--fromdb}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run The CRUD Generators';

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
    public function handle()
    {

        if($this->option('fromdb')) {
            
        }
        
        $this->banner();

        $style = new OutputFormatterStyle('green', 'default', ['bold']);
        $this->output->getFormatter()->setStyle('bold', $style);
        $class = $this->option('class');
        
        (new CrudBuilder)->run($this);

        if($this->option("migrate")) {
            Artisan::call('migrate');
            $this->line(Artisan::output());
        }

        $this->line('Job Successfully.');
    }
}
