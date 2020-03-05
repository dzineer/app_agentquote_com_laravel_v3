<?php

namespace Dzineer\LandingPages;

use Illuminate\Support\Facades\Log;

/**
 * Class LandingPages
 *
 * @package Dzineer\LandingPages
 */
class LandingPages {

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	protected function getConfig() {
		return config('landing_page.domain');
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public function routePathPrefix() {
		return '';
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public function apiRoutePathPrefix() {
		return '';
	}

}