<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\DeviceLoginTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Arr;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers; /*, ThrottlesLogins;*/
    const ACTIVE = 1;
    const NOT_ACTIVE = 0;

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password'); // get data from login form
        dd(Arr::add($credentials, 'active', self::ACTIVE));
        return Arr::add($credentials, 'active', self::ACTIVE);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {

/*        $routes = collect(\Route::getRoutes())->map(function ($route) { return $route->uri(); });

        $previousPath = $this->getPreviousRequestedRoute();

        foreach ($routes as $route) {
            // dnd([$route, $previousPath]);
            if (
                $route === $previousPath
            ) {
                // dd([$route, $previousPath, "found"]);
               // dd(["setting url.intended", $previousPath]);
                Session::put(
                    'intended_request',
                    $previousPath
                );
                session()->save();
            } else {
                Session::remove(
                    'intended_request'
                );
            }
        }*/

        return view('auth.login');
    }


    // Note: commented this out 2019-08-08 - 02:08:02 PM
    // TODO: check if this works or not
	/*protected function authenticated(Request $request, $user)
	{
	    auth()->logoutOtherDevices($request->input('password'));


        if ($user->active === 0) {

            $message = 'Please content Agent Quote Support. Thank you.';

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
            session()->put('lastActivityTime', time());
			return redirect()->route('dashboard');
		}
	}*/

/*	protected function setDeviceLogoutAndRedirect()
	{

		session(
			[
				'device-logout' => true
			]
		);

		return redirect()->route('user.quote.show');
	}*/
    /**
     * @return mixed|string
     */
    private function getPreviousRequestedRoute() {
        $previousPath = str_replace( url( '/' ), '', url()->previous() );

        $previousPath = ltrim( $previousPath, '/' );

        // dnd( [ "url.intended", $previousPath ] );

        return $previousPath;
    }
}
