<?php

namespace App\Providers;

use App\Libraries\AQLogger;
use Illuminate\Support\ServiceProvider;

class AQLoggerServiceProvider extends ServiceProvider
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
        $this->app->singleton('AQLog', function () {
            return new AQLogger();
        });
    }

}
