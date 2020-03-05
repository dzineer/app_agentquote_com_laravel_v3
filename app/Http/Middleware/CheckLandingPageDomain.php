<?php

namespace App\Http\Middleware;

use App\Libraries\VanityDomain;
use App\Models\UserSubdomain;
use Closure;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\LandingPages\Models\UserDomain;
use Illuminate\Support\Facades\Redirect;
use App\Facades\AQLog;

class CheckLandingPageDomain {

    public function handle($request, $next) {

        $customModule = null;
        $url = request()->getHttpHost();
        
        $host = $url;

        $vanityDomain = new VanityDomain(
            config('agentquote.defaults.main.vanity_domain')
        );

        $validSubdomain = $vanityDomain->belongsTo($host);

        if ($validSubdomain) {
            AQLog::info("valid type subdomain");
        } else {
            AQLog::info("not a valid type subdomain");
        }

        $subDomain = UserSubdomain::whereSubdomain(
            $vanityDomain->getSubdomain()
        )->first();

        // okay we got our sub domain so we just need to return it

        if ($subDomain) {
            // there is no need of a custom domain when accessing /fe or /termlife
            $request->merge(array("subdomain" => $subDomain, "path" => $request->path(), "customDomainLandingPage" => false));
            return $next($request);
        }

        // dd($domainName);
        // $domain = $request->route('domain');

        $domainRecord = UserDomain::where('domain', $host);

        if ($domainRecord->exists()) {
            $domain = UserDomain::where('domain', $host)->first();
            $customModules = CustomModules::getUserModules($domain['user_id']);
            // dd($customModules);
        } else {
            // no domain
            return $next($request);
        }

        // dd($domain);

        if ($domain['custom_module_id'] !== null) {
            $customModule = CustomModules::getUserModuleById($domain['custom_module_id'], $domain['user_id']);
            // dnd($domainName, $domain, $customModule);
            if ($customModule) {
                // dnd("inside");
                // dnd($customModule->data);
                $data = json_decode($customModule['data'], true);
                // dnd($data['landing_page_domain']);
                // dnd(["data", $data, $domainName, $data['landing_page_domain']]);
                if (isset($data['landing_page_domain']) && $data['landing_page_domain'] === $domainName ) {
                    // dd(["huh", $customModule]);
                    $request->merge(array("domain" => $domain, "path" => $request->path(), "customModule" => $customModule, "customDomainLandingPage" => true));
                    // dd($customModule);
                }
            } else {
                $request->merge(array("domain" => $domain, "path" => $request->path(), "customModule" => $customModule, "customDomainLandingPage" => false));
            }
        } else {
            $request->merge(array("domain" => $domain, "path" => $request->path(), "customDomainLandingPage" => false));
        }

        
        return $next($request);
    }

}
