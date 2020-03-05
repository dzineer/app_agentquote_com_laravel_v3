<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CustomModules\UserCustomPagesModule;
use App\Http\Controllers\ProductPageController;

/*
    Provider boots routes for custom pages
*/

class ProductPagesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $router = app()->make('router');
        $routes = [
            [ "path" => 'products-services/life-insurance/term-life', "view" => "/landing-pages/pages/life-insurance/term-life/quote-page" ],
            [ "path" => 'products-services/life-insurance/mortgage-protection', "view" => "/landing-pages/pages/life-insurance/mortgage-protection/quote-page" ],
            [ "path" => 'products-services/life-insurance/burial-insurance', "view" => "/landing-pages/pages/life-insurance/burial-insurance/quote-page" ],
        ];

        if(! $routes) 
            return;

        foreach($routes as $route) {

            $router->group([
                'middleware' => ['landing-pages.domains']
            ], function() use($route, $router) {
                $router->get($route["path"], [ProductPageController::class, 'index']);
            });
            
        }
    }
}
