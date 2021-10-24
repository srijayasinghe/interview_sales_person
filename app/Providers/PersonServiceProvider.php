<?php

namespace App\Providers;

use App\Services\PersonService;
use Illuminate\Support\ServiceProvider;

class PersonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Interfaces\PersonInterface', function($app){
            return new PersonService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
