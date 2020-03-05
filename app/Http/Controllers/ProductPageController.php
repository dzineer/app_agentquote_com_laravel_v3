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
use App\Libraries\LandingPageDetails;

class ProductPageController extends Controller
{   
    // public function index( Request $request, $subomain, $customModule ) {
    public function index( Request $request ) {
        // if is vanity subdomain or custom domain ? 
        // yes - has category ?
        // display category product service page
        // no - display default category product service page

        $routes = [
            [ "path" => 'products-services/life-insurance/term-life', "view" => "/landing-pages/pages/life-insurance/term-life/quote-page" ],
            [ "path" => 'products-services/life-insurance/mortgage-protection', "view" => "/landing-pages/pages/life-insurance/mortgage-protection/quote-page" ],
            [ "path" => 'products-services/life-insurance/burial-insurance', "view" => "/landing-pages/pages/life-insurance/burial-insurance/quote-page" ],
        ];

        $requestedPath = '';

        if ($request->has('path')) {
            $requestedPath = $request->instance()->query('path');
        } else {
            return abort(404);
        }

        // dd($requestedPath);

        $requestedRoute = array_filter($routes, function($route) use($requestedPath) {
            return $route['path'] === $requestedPath;
        });

        if (count($requestedRoute)) {
            $requestedRoute = array_pop($requestedRoute);
        }

        $user = null;
        $domain = null;

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

        if ($request->path === '/') {
            $template = 'landing-pages/pages/life-insurance/' . $landingPageUser->category->token . '/' . 'quote-page';
        } else {
            $template = $requestedRoute['view'];
        }
        
        $landingPageDetails = new LandingPageDetails();

        $landingPageDetails->setLandingPageUserCategory( $landingPageUser );
        $landingPageDetails->setGACode( $gaCode );

        return (new VanityHost)->byHost( $user, $landingPageDetails, $template );
    }

    private function getProductType( $moduleName ) {

        $product = '';

        switch ( $moduleName ) {
            case 'termlife_module':
                $product = 'term-life';
                break;

            case 'fe_module':
                $product = 'burial-insurance';
                break;

            case 'sit_module':
                $product       = 'mortgage-protection';
                break;   

            default:
            $product = 'term-life';
        }    

        return $product;
    }


}