<?php

namespace App\Providers;

use App\Composers\NotificationsComposer;
use App\Composers\SuperAdComposer;
use App\Models\SuperAd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Schema::defaultStringLength(191);

        \View::composer(
            '*', SuperAdComposer::class
        );


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // use this on live server

/*        $this->app->bind('path.public', function() {
            return base_path() . '/../html';
        });*/
    }
}
