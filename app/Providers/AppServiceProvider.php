<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Extend Validator Re-Captcha
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');

        Builder::defaultStringLength(191); // Update defaultStringLength

        //HTTPS Schames
        if(conf('force-https')) {
            URL::forceScheme('https');
        }
    }
}
