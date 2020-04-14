<?php

namespace App\Providers;

use JonathanTorres\MediumSdk\Medium;
use Illuminate\Support\ServiceProvider;

class MediumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('medium-php-sdk', function(){
            return new Medium(config('medium'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make('router')->get('medium', function(){
            return 'medium home';
        });
    }
}
