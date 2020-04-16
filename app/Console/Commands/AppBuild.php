<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class AppBuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $zip = new ZipArchive();

        $fileName=env('APP_NAME').'-'.env('APP_VERSION').".zip";
        dd(env('APP_NAME'));
        // if(file_exists("./".$fileName)) {
        
        //         unlink ("./".$fileName); 
        
        // }

        if ($zip->open("./".$fileName, ZIPARCHIVE::CREATE) != TRUE) {
                die ("Could not open archive");
        }
        // dd(glob("./*"));
        // // dd(scandir('./'));
        // foreach (glob("./*") as $file) {
        //     if(strpos('/app', $file) > -1) {

        //         if(!is_dir($file)) {
        //         }
        //     }
            
        // }
        $zip->addFile("./artisan");


        // close and save archive
        
        $zip->close(); 
    }
}
