<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\LandingPageUser;
use App\Models\UserGoogleAnalytic;
use App\User;
use Dzineer\CustomModules\Facades\CustomModules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Libraries\VanityHost;
use App\Libraries\iLandingPageDetails;
use App\Libraries\LandingPageDetails;

class PageController extends Controller
{
    // public function index( Request $request, $subomain, $customModule ) {
    public function index( Request $request ) {
        // if is vanity subdomain or custom domain ?
        // yes - has category ?
        // display category product service page
        // no - display default category product service page

        // dd($request);

        $requestedPath = '';

        if ($request->has('path')) {
            $requestedPath = $request->instance()->query('path');
        } else {
            return abort(404);
        }

        $user = null;
        $domain = null;

        $routes = [
            [ "path" => 'featured-tips/why-life-insurance-makes-sense', "view" => "/landing-pages/pages/featured-tips/why-life-insurance-makes-sense" ],
            [ "path" => 'featured-tips/how-much-life-insurance-do-i-need', "view" => "/landing-pages/pages/featured-tips/how-much-life-insurance-do-i-need" ],
            [ "path" => 'featured-tips/but-i-already-have-insurance', "view" => "/landing-pages/pages/featured-tips/but-i-already-have-insurance" ],
            [ "path" => 'featured-tips/your-family-trusts-you-consider-burial-or-final-expense-insurance', "view" => "/landing-pages/pages/featured-tips/your-family-trusts-you-consider-burial-or-final-expense-insurance" ],
            [ "path" => 'featured-tips/what-happens-to-my-policy-if-i-change-my-mortgage', "view" => "landing-pages/pages/featured-tips/what-happens-to-my-policy-if-i-change-my-mortgage" ],
        ];

        $requestedRoute = array_filter($routes, function($route) use($requestedPath) {
            return $route['path'] === $requestedPath;
        });

        if (count($requestedRoute)) {
            $requestedRoute = array_pop($requestedRoute);
        }

        if ( $request->has('subdomain') ) {
            $domain = $request->instance()->query('subdomain');
            $user = User::find( $subomain['user_id'] );
           // $customUserModule = CustomModules::getUserModule($moduleName, $user->user_id);
        } else if ( $request->has('domain') ) {
            // get user based on domain name
            $domain =  $request->instance()->query('domain');
            $user = User::find( $domain['user_id'] );
           // $customUserModule = CustomModules::getUserModule($moduleName, $user->user_id);
        } else {
            return abort( 405 );
        }

        if ( ! $user ) {
            return abort( 405 );
        }

        $landingPageUserRecord = LandingPageUser::where(['user_id' => $user->id])->first();

        if ( ! $landingPageUserRecord->exists()) {
            return abort( 405 );
        }

        $landingPageUser = $landingPageUserRecord->first();

        $gaCode = '';
        $gaCodeRecord = UserGoogleAnalytic::where(['user_id' => $user->id])->first();

        if ($gaCodeRecord) {
            $gaCode = $gaCodeRecord->data;
        }

/*          dd([
            $domain,
            $user,
            $landingPageUser,
            $user->profile
        ]); */

        $template = $requestedRoute['view'];

        $landingPageDetails = new LandingPageDetails();
        $landingPageDetails->setLandingPageUserCategory( $landingPageUser );
        $landingPageDetails->setGACode( $gaCode );

        return (new VanityHost)->byHost( $user, $landingPageDetails, $template );
    }
}
