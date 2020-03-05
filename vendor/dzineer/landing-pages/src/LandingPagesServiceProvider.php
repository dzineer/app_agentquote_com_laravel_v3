<?php

namespace Dzineer\LandingPages;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Dzineer\LandingPages\Facades\LandingPages;

class LandingPagesServiceProvider extends ServiceProvider {

	public function boot(Route $route) {

		$this->registerResources();
        $this->defineMiddlewareGroup();

	}

	public function register() {

	}

  public function defineMiddlewareGroup() {

		$router = $this->app['router'];
		$router->prependMiddlewareToGroup('landing-page.domain', '\Dzineer\LandingPages\Http\Middleware\CheckLandingPageDomain');
		// $router->pushMiddlewareToGroup('landing-page', \Dzineer\LandingPages\Http\Middlware\SomeClass::class); or

  }

	private function registerResources() {

		// $this->loadMigrationsFrom( __DIR__ . '/../database/migrations' );
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'landing_pages');

		$this->registerFacade();
		// $this->registerRoutes();

	}

	protected function registerRoutes() {
		Route::group( $this->routeConfiguration(), function() {
			$this->loadRoutesFrom( __DIR__ . '/../routes/web.php' );
		});

		Route::group( $this->apiRouteConfiguration(), function() {
			$this->loadRoutesFrom( __DIR__ . '/../routes/api.php' );
		});
	}

	private function routeConfiguration() {
		return [
			'prefix' => LandingPages::routePathPrefix(),
			'namespace' => 'Dzineer\LandingPages\Http\Controllers',
		];
	}

	private function apiRouteConfiguration() {
		return [
			'prefix' => LandingPages::apiRoutePathPrefix(),
			'namespace' => 'Dzineer\LandingPages\Http\Controllers\Api',
		];
	}

	protected function registerFacade() {
		$this->registerFacades();
	}

	private function registerFacades() {
		$this->app->singleton('LandingPages', function($app) {
			return new LandingPages();
		});
	}

}
