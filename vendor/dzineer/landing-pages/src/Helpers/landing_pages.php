<?php

use Dzineer\LandingPages\Models\UserDomain;

if (!function_exists('landing_page')) {
    /**
     * Get shop by subdomain
     *
     * @param null $subdomain
     *
     * @return \Dzineer\LandingPages\Models\UserDomain
     */
    function landing_page($domain = null)
    {
	    $domain = $domain ?: request()->route('domain');
        $landingPage = UserDomain::where('domain', $domain)->first();
        if (!$landingPage) {
            return new LandingPage;
        }
        return $landingPage;
    }
}
if (!function_exists('domain')) {
    /**
     * Get current domain
     *
     * @return \Dzineer\LandingPages\Models\UserDomain
     */
    function domain()
    {
	    $domain = request()->route('domain');
        return $domain;
    }
}
if (!function_exists('domain_route')) {
    /**
     * Generate the URL to a named route.
     * This is a modified version of Laravel's route() function
     * Pass subdomain value automatically
     *
     * @param  array|string $name
     * @param  mixed $parameters
     * @param  bool $absolute
     * @return string
     */
    function domain_route($name, $parameters = [], $absolute = true)
    {
        $parameters['domain'] = request()->route('domain');
        return app('url')->route($name, $parameters, $absolute);
    }
}
