<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {        
        $this->app->singleton('ModelService', function ($app) {
            return new \App\Api\V1\Services\ModelService($app);
        });
    }
}
