<?php

namespace App\Http\Controllers;

use App\Libraries\OtpSecurity;
use Illuminate\Http\Request;

/**
 * Class OtpController
 * @package App\Http\Controllers
 */
class OtpController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request) {
		if ($request->has('otp')) {
			if (OtpSecurity::auth(
				$request->get('otp')
			)) {
	//			return response()->json( array("success" => true, "message" => "logged in") );
				return redirect()->route('dashboard');
			}
			return response()->json( array("success" => false, "message" => "Invalid request") );
		}
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function generate(Request $request) {
	    if ($request->has('userid') && $request->has('password')) {
		    $result = OtpSecurity::generate(
			    $request->get('userid'),
			    $request->get('password')
		    );
		    if (strlen($result)) {
		    	return response()->json( array("success" => true, "otp" => $result) );
		    }
		    return response()->json( array("success" => false, "message" => "Invalid request") );
		}
    }
}
