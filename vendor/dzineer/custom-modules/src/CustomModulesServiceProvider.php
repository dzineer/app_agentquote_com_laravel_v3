<?php

namespace Dzineer\CustomModules;

use Dzineer\CustomModules\Library\Mediators\CustomModuleMediator;
use Dzineer\CustomModules\Library\ModuleMediator;
use Dzineer\CustomModules\Repositories\CustomModuleRepository;
use Dzineer\CustomModules\Repositories\UserDomainRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Dzineer\CustomModules\Facades\CustomModules;

/**
 * Class CustomModulesServiceProvider
 *
 * @package Dzineer\CustomModules
 */
class CustomModulesServiceProvider extends ServiceProvider {
	/**
	 * @var
	 */
	private $modules;

	/**
	 *
	 */
	public function boot() {
		$this->registerResources();
	}

	/**
	 *
	 */
	public function register() {}

	/**
	 *
	 */
	private function registerResources() {

		$this->loadMigrationsFrom( __DIR__ . '/../database/migrations' );
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'custom_modules');

		$this->registerFacade();
		$this->registerRoutes();
		// $this->loadCustomModules();
		$this->loadCustomModules();

	}

	/**
	 *
	 */
	protected function registerRoutes() {
		Route::group( $this->routeConfiguration(), function() {
			$this->loadRoutesFrom( __DIR__ . '/../routes/web.php' );
		});

		Route::group( $this->apiRouteConfiguration(), function() {
			$this->loadRoutesFrom( __DIR__ . '/../routes/api.php' );
		});
	}

	/**
	 * @return array
	 */
	private function routeConfiguration() {
		return [
			'prefix' => CustomModules::routePathPrefix(),
			'namespace' => 'Dzineer\CustomModules\Http\Controllers',
		];
	}

	/**
	 * @return array
	 */
	private function apiRouteConfiguration() {
		return [
			'prefix' => CustomModules::apiRoutePathPrefix(),
			'namespace' => 'Dzineer\CustomModules\Http\Controllers\Api',
		];
	}

	/**
	 *
	 */
	protected function registerFacade() {
		$this->registerFacades();
	}

	/**
	 *
	 */
	private function registerFacades() {
		$this->app->singleton('CustomModules', function($app) {
			return new \Dzineer\CustomModules\CustomModules(new CustomModuleMediator, new CustomModuleRepository, new UserDomainRepository);
		});
		$this->app->singleton('DZNonce', function($app) {
			return new \Dzineer\Security\DZNonce();
		});
	}

	/**
	 *
	 */
	private function loadCustomModules() {
		CustomModules::loadModules();
	}

}