<?php

namespace Dzineer\LandingPages\Http\Middleware;

use Closure;
use Dzineer\LandingPages\Models\UserDomain;

class CheckLandingPageDomain {

	public function handle($request, $next) {
		$subdomain = $request->route('subdomain');
        $landingPage = UserDomain::where('domain', $subdomain)->first();
		dd($landingPage);
        if ( ! $landingPage) {
		 	// @todo: redirect to not exist page
			return redirect()->route('app.home');
		}
		return $next($request);
	}

}
