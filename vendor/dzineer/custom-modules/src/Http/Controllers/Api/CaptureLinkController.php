<?php

namespace Dzineer\CustomModules\Http\Controllers\Api;

use Dzineer\CustomModules\Models\UserModuleMonitorLink;
use Dzineer\CustomModules\Models\LinkMonitor;
use Illuminate\Http\Request;
use Dzineer\CustomModules\Http\Controllers\Controller;
use Dzineer\CustomModules\Models\HashCustomModuleUser;
use Illuminate\Http\Response;

/**
 * Class CaptureLinkController
 *
 * @package Dzineer\CustomModules\Http\Controllers\Api
 */
class CaptureLinkController extends Controller
{
	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function index(Request $request)
    {
    	// dd($request->input('i'));
	    // $hashKeyId = base64_decode($request->input('i'));
	    // dd( $hashKeyId );

    	if ($request->has('i')) {
    		
    		$base64String = $request->input('i');
    		$hashKeyId = base64_decode($base64String);
		    $userModuleMonitorLink = UserModuleMonitorLink::where(['hash_id' => $hashKeyId])->first();

		   // dd($userModuleMonitorLink);

		    if ($userModuleMonitorLink) {

			    LinkMonitor::create([
				    'monitor_link_id' => $userModuleMonitorLink['id'],
				    'ip_address' => $request->ip(),
				    'monitor_type' => 'module_link'
			    ]);

				// TODO not redirect to module but just redirect
			    $link = base64_decode( $userModuleMonitorLink->encoded_url );
			    return redirect($link);
		    } else {
		    	return response()->json([
		    		'Error' => 'invalid request'
			    ], Response::HTTP_NOT_FOUND);
		    }
	    }

	    return response()->json([
		    'Error' => 'invalid request'
	    ], Response::HTTP_NOT_FOUND);
    }

}
