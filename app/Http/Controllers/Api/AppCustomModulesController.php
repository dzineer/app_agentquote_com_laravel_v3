<?php

namespace App\Http\Controllers\Api;

use Chumper\Zipper\Facades\Zipper;
use Dzineer\CustomModules\Facades\CustomModules;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use ZipArchive;

/**
 * Class AppCustomModulesController
 *
 * @package App\Http\Controllers\Api
 */
class AppCustomModulesController extends Controller
{
    /**
     * AppCustomModulesController constructor.
     */
    public function __construct()
	{
	}

    /**
     * @param \Illuminate\Http\Request $request
     * @param $userId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function action(Request $request)
    {

        if ($request->has('module') ) {


            if ($request->has('action') ) {
                if ($request->has('options')) {

/*                    return response()->json([
                        "success" => false,
                        "action" => $request->input('action'),
                        "options" => $request->input('options'),
                    ]);*/

/*                    return response()->json([
                        "success" => false,
                        "action" => $request->input('action'),
                        "options" => $request->input('options'),
                        "info" => 'in action'
                    ]);*/

                    return CustomModules::customModuleAction( $request->input('module'), $request->input('action'), $request->input('options')  );
                } else {
                    return CustomModules::customModuleAction( $request->input('module'), $request->input('action'), null );
                }
            }

        } else {

            if ($request->has('options')) {

                $options = $request->input( 'options' );

                $optionsObj = json_decode( $options );

/*                return response()->json( [
                    "success"   => false,
                    "action"    => $request->input( 'action' ),
                    "options"   => $request->input( 'options' ),
                    "message" => $optionsObj->module,
              //      "nfo back" => CustomModules::customModuleAction( $optionsArr['module'], $request->input( 'action' ), $request->input( 'options' ) ),
                    "info"      => 'in action'
                ] );*/

                return CustomModules::customModuleAction( $optionsObj->module, $request->input('action'), $request->input('options')  );

            }

            return response()->json([
                "success" => false,
                "message" => "Module does not exist!",
                "error" => "Module does not exist!"
            ]);
        }

    }

}
