<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ZipArchive;

class UserManagement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial Core';

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

        $this->check_installed();

        $dir            = app_path('Core');
        $controllers    = $dir . "/Controllers";
        $models         = $dir . "/Models";
        
        $this->download();die;
        $this->extract();
        $this->install();

        if(is_dir($dir)) {
            $reset = $this->ask('"Core" Already installed, Rewrite? [yes]');
            if($reset == 'yes' | $reset == "Y") {
                
                $confirm = $this->ask('All changes in "Core" will be reset, you sure..? [yes]');
                
                if($confirm == 'yes' | $confirm == "Y") {

                    unlink(app_path('Core'));
                    $this->info($confirm);

                } else {

                }
            }
        }
    }

    function install() {
        $routes = app_path('../routes/web.php');
        $append = file_get_contents($routes);
\file_put_contents($routes, $append . '
Route::middleware(["auth"])->group(function() {
    if(is_dir(__DIR__ . "/../app/Core")) {
        //Core Routes
        require_once __DIR__ . "/../app/Core/routes.php";
    }
});
');
        $this->info($routes . " Updated...");
    }

    function extract($filename="Core.zip") {
        $this->info("Extract to project...");
        try {
            
            $zip        = new ZipArchive();
            $filePath   = app_path($filename);
            $res        = $zip->open($filePath);
    
            if (is_bool($res) && $res == true) {
                $zip->extractTo(app_path('/'));
                $this->info("Successfully installed!");
                $this->info("Core added to:" . app_path('Core'));
            } else {
                $this->error($filePath . " Not Found!");
            }

        } catch (\Exception $err) {
            $this->error($err->getMessage());
        }
    }

    function download() {
        $key = $this->ask('Enter the purchase code: ');
        
        $this->info("Validating...");

        $this->info("Downloading ...");
        $get = file_get_contents('https://json-app.com/');
        $this->info("Download Successfull...");
    }

    function check_installed() {
        $dir = app_path('Core');

        if(is_dir($dir)) {
            $this->info('Core has installed');
            $this->info('Location: ' . $dir);
            die;
        }
    }
}
