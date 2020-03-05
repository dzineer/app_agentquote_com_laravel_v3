<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 10/4/18
 * Time: 6:22 PM
 */

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

trait DeviceLoginTrait
{
	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showDeviceLoginForm()
	{
		return view('auth.device.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function deviceLogin(Request $request)
	{
		$this->deviceValidateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the deviceUsername and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request))
		{

			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		if ($this->deviceAttemptLogin($request))
		{
			return $this->deviceSendLoginResponse($request);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->deviceSendFailedLoginResponse($request);
	}

	/**
	 * Validate the user login request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return void
	 */
	protected function deviceValidateLogin(Request $request)
	{
		$this->validate($request, [
			$this->deviceUsername() => 'required|string',
			'password'        => 'required|string',
		]);
	}

	/**
	 * Attempt to log the user into the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return bool
	 */
	protected function deviceAttemptLogin(Request $request)
	{
		return $this->deviceGuard()->attempt(
			$this->deviceCredentials($request), $request->filled('remember')
		);
	}

	/**
	 * Get the needed authorization deviceCredentials from the request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	protected function deviceCredentials(Request $request)
	{
		return $request->only($this->deviceUsername(), 'password');
	}

	/**
	 * Send the response after the user was deviceAuthenticated.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	protected function deviceSendLoginResponse(Request $request)
	{
		$request->session()->regenerate();

		$this->clearLoginAttempts($request);

		$this->redirectTo = 'user/quote';

		//dd('Opening up to: ' .$this->redirectTo);
		//mdd("okay here is the real redirect path: ". $this->redirectPath());

		$_SESSION['device.logged'] = true;

		$authenticated = $this->deviceAuthenticated($request, $this->deviceGuard()->user());

		return $authenticated
			? redirect()->route('user.quote.show') : redirect()->route('device.login');

/*		return $authenticated
			?: redirect()->intended($this->redirectPath());*/
	}

	/**
	 * The user has been deviceAuthenticated.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  mixed                    $user
	 *
	 * @return mixed
	 */
	protected function deviceAuthenticated(Request $request, $user)
	{
		//
	}

	/**
	 * Get the failed login response instance.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function deviceSendFailedLoginResponse(Request $request)
	{
		throw ValidationException::withMessages([
			$this->deviceUsername() => [trans('auth.failed')],
		]);
	}

	/**
	 * Get the login deviceUsername to be used by the controller.
	 *
	 * @return string
	 */
	public function deviceUsername()
	{
		return 'email';
	}

	/**
	 * The user has logged out of the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return mixed
	 */
	protected function deviceLoggedOut(Request $request)
	{
		//
	}

	/**
	 * Get the deviceGuard to be used during authentication.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function deviceGuard()
	{
		return Auth::guard();
	}
}
