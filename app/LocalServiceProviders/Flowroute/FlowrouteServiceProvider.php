<?php

namespace App\LocalServiceProviders\Flowroute;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class FlowrouteServiceProvider extends ServiceProvider
{
    private $debug = true;
    use \App\Libraries\Utilities\AQLogger;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->singleton(Flowroute::class, function ($app) {
            // use Illuminate\Support\Facades\Log;
            // $this->AQLog( "\n::boot - services.flowroute: " . print_r(config('services.flowroute'),true) . "" );
            return new Flowroute(config('services.flowroute'));
        });

    }

}
