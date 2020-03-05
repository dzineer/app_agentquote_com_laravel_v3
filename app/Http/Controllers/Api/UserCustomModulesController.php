<?php

namespace App\Http\Controllers\Api;

use Dzineer\CustomModules\Facades\CustomModules;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class UserCustomModulesController extends Controller
{
	public function __construct()
	{
	}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

/*        return response()->json([
            "success" => false,
            "info" => $request->all()
        ]);*/

        $userModule = CustomModules::getUserModuleById( $id, Auth::user()->id );

/*        return response()->json([
            "success" => false,
            "info" => $userModule
        ]);*/

        if (!$userModule) {
            return response()->json([
                "error" => "Module does not exist!"
            ], 404);
        }

        if ($request->has('custom')) {
            $data = $request->input('config');
            // return CustomModules::onHook( 'onUpdate', $userModule->module->module_name, $userModule->module, $data );
            return CustomModules::saveUserModuleData( $userModule->id, $userModule->user_id, $data );

        } else {

            $params = json_decode( $userModule['data'], true );

            foreach( $params  as $key => $val ) {
                if ( isset( $params[$key] ) && $request->has($key)) {
                    $params[ $key ] = $request->input( $key );
                }
            }
            // $module_id, $userId, $data
            return CustomModules::saveUserModuleData( $userModule->id, $userModule->user_id, $params );
        }
        // dd($userModule);

        return response()->json([
            "success" => true,
            "message" => "Analytics updated."
        ]);

    }
}
