<?php

namespace App\Http\Middleware;

use Closure;
use Dzineer\LandingPages\Models\UserDomain;

class CheckLandingPageSubDomain {

	public function handle($request, $next) {
		$subdomain = $request->route('subdomain');
        $subdomain = UserDomain::where('domain', $subdomain)->first();

        $request->merge(array("domain" => $subdomain));

        if ( ! $subdomain) {
		 	// @todo: redirect to not exist page
			return redirect()->route('app.home');
		}
		return $next($request);
	}

}
