<?php

namespace App\Providers;

use App\CustomModules\Console\Commands\GenerateCustomModuleCommand;
use Illuminate\Support\ServiceProvider;

class CustomModulesServiceProvider extends ServiceProvider
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
        $this->commands(
            GenerateCustomModuleCommand::class
        );
    }
}
