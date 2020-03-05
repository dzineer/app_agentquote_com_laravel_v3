<?php

use App\Models\LandingPage;

if (!function_exists('landing_page')) {
    /**
     * Get shop by subdomain
     *
     * @param null $subdomain
     *
     * @return \App\Models\LandingPage
     */
    function landing_page($subdomain = null)
    {
        $subdomain = $subdomain ?: request()->route('subdomain');
        $landingPage = LandingPage::where('subdomain', $subdomain)->first();
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
     * @param null $subdomain
     * @return \App\Models\LandingPage
     */
    function domain()
    {
        $subdomain = request()->route('subdomain');
        return $subdomain;
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
        $parameters['subdomain'] = request()->route('subdomain');
        return app('url')->route($name, $parameters, $absolute);
    }
}
