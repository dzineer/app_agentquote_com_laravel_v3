<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SecureLoginController extends LoginController{

    protected function authenticated(Request $request, $user)
    {

        // dd(["all", Session::all()]);

        auth()->logoutOtherDevices($request->input('password'));

        if ($user->active === 0) {

            $message = 'Please content AgentQuote Support. Thank you.';

            $this->logout($request);

            return redirect()->back()
                             ->withInput($request->only($this->username(), 'remember'))
                             ->withErrors([
                                 $this->username() => $message
                             ]);
        }
        else if ($request->has('device_login') && $request->input('device_login') === "true") {
            //$request->session()->push('device.logout', 'device.logout');
            return $this->setDeviceLogoutAndRedirect();
        }
        else
        {
            // get all supported routes and check that ... if requested route prior to being redirected to login page exists
            // if so redirect to that route

            $routes = collect(\Route::getRoutes())->map(function ($route) { return $route->uri(); });

            $urlIntended = $this->getIntededURL();

            // dnd(["url.intended", $urlIntended, $routes ]);

            foreach ($routes as $route) {
                // dnd($route);
                if (
                    $route === $urlIntended
                ) {
                   // dd(["found it", $route]);
                    return redirect(
                        session()->get('url.intended')
                    );
                }
            }

           // dd(["not found"]);

            return redirect()->route('dashboard');
        }
    }

    /**
     * @return string
     */
    private function getIntededURL(): string {
        $urlIntended = ltrim( str_replace( url( '/' ), '', session()->get( 'url.intended' ) ), '/' );

        return $urlIntended;
    }
}
