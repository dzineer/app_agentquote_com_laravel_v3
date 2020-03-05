<?php

namespace App\Http\Controllers;

use App\Libraries\OtpSecurity;
use Illuminate\Http\Request;

/**
 * Class VerifyController
 * @package App\Http\Controllers
 */
class VerifyController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request) {
		echo "hey"; exit;
		if ($request->has('email') && $request->has('email_password')) {
			$result = UserSecurity::auth(
				$request->get('email'),
				$request->get('email_password')
			);
			if (strlen($result)) {
				return response()->json( array("success" => true) );
			}
		}
		return response()->json( array("success" => false) );
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function json_login(Request $request) {
		echo "hey"; exit;
		echo json_encode( array("success" => false, "message" => 'before checking') ); exit;
		$data = json_decode( file_get_contents('php://input') );

		return response()->json( array("success" => true, "message" => $data) );

		if (isset($data->email) && isset($data->email_password)) {
			$result = UserSecurity::auth(
				$data->email,
				$data->email_password
			);
			if (strlen($result)) {
				return response()->json( array("success" => true) );
			}
			return response()->json( array("success" => false, "message" => "We were not able to verify you") );
		}
	}
}
