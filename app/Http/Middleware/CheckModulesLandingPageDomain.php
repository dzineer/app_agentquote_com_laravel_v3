<?php

namespace App\Http\Middleware;

use Closure;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\LandingPages\Models\UserDomain;

class CheckModulesLandingPageDomain {

	public function handle($request, $next) {

//        dd("we are here");

	    $customModule = null;
        $domainName = request()->getHttpHost();
		// $domain = $request->route('domain');
        $domain = UserDomain::where('domain', $domainName)->first();

        // dd($domain, $domainName, $customModule);

        if ($domain['custom_module_id'] !== null) {
            // dnd($domainName, $domain, $customModule);
            $customModule = CustomModules::getUserModuleById($domain['custom_module_id'], $domain['user_id']);
            // dd($domainName, $domain, $customModule);
            if ($customModule) {
                $data = json_decode($customModule['data'], true);
                if (isset($data['landing_page_domain']) && $data['landing_page_domain'] === $domainName ) {
                    $request->merge(array("domain" => $domain, "customModule" => $customModule));
                   // return array("domain" => $domain, "customModule" => $customModule);
                }
            }
        }
        // dd($domain, $domainName, "nope");
/*        // dd($domain);

        if ( ! $customModule) {
		 	// @todo: redirect to not exist page
			// return redirect()->route('app.home');
            return abort(404);
		}*/
		return $next($request);
	}

}
