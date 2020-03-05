<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 4:38 PM
 */

namespace App\Http\Controllers;
use App\Libraries\AQProxyService;
use Illuminate\Http\Request;

class AQProxy {
	public function proxy(Request $request) {
		// $service = new ZohoProxyService();
		$service = new AQProxyService();
		// $request->session()->save();
		$result = $service->process_request( $request );
		return response()->json(  $result );
	}
}