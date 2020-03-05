<?php

namespace App\Http\Controllers;

use App\Exceptions\NotAuthorizedException;
use App\Libraries\OtpSecurity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;

/**
 * Class OtpController
 * @package App\Http\Controllers
 */
class PasswordResetController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function login(Request $request) {


		if ($request->has('otp')) {
			if (OtpSecurity::auth(
				$request->has('otp')
			)) {
				return response()->json( array("success" => true, "message" => "logged in") );
			}
			return response()->json( array("success" => false, "message" => "Invalid request") );
		}
    }

	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function generate(Request $request) {

        $user = Auth::user();

        $result = $this->resetPasswordIfCan($request, $user);

        if (strlen($result)) {
            return response()->json( array("success" => true, "otp" => $result) );
        }
        return response()->json( array("success" => false, "message" => "Invalid request") );
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function generate_by_admin(Request $request) {

        $user = Auth::user();

        $result = $this->resetPasswordIfCan($request, $user);

        if (strlen($result)) {
            return response()->json( array("success" => true, "otp" => $result) );
        }
        return response()->json( array("success" => false, "message" => "Invalid request") );
    }

    /**
     * @param Request $request
     * @param Authenticatable|null $user
     * @return string
     */
    private function resetPasswordIfCan(Request $request, Authenticatable $user): string
    {
        $result = null;

        if ($user->is_affiliate() || $user->id_admin() || $user->is_manager()) {

            try {
                $result = OtpSecurity::generate_by_admin($request->get('id'));
            }
            catch(NotAuthorizedException $e) {
                echo response()->json( array("success" => false, "message" => $e->getMessage() ) );
                exit(1);
            }

        } else {
            if ($request->has('userid') && $request->has('password') && $user->email === $request->get('userid') ) {

                $result = OtpSecurity::generate($request->get('userid'), $request->get('password'));
            }
        }

        return $result;
    }
}
