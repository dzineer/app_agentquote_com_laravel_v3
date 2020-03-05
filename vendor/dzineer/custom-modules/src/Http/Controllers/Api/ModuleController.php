<?php

namespace Dzineer\CustomModules\Http\Controllers\Api;

use Dzineer\CustomModules\Facades\CustomModules;
use Illuminate\Http\Request;
use Dzineer\CustomModules\Http\Controllers\Controller;
use Dzineer\CustomModules\Models\HashCustomModuleUser;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	// return $request->input('i');

    	if ($request->has('i')) {

    		$base64String = $request->input('i');
    		$hashKeyId = base64_decode($base64String);
		    $hashCustomModuleUser = HashCustomModuleUser::where(['hash_id' => $hashKeyId])->first();

    		// $modId = $hashes[ $hashKeyId ];
		    if ( $hashCustomModuleUser->custom_modules_user->module ) {

		    	$userModule = $hashCustomModuleUser->custom_modules_user;
			    $module = $hashCustomModuleUser->custom_modules_user->module;
			    $moduleData = json_decode($module->data,true);
			    $param = json_decode($userModule->data,true);

			    return CustomModules::onHook( "onRender", $module->module_name, [ "module_data" => $moduleData, "parameters" => $param ] );
		    }

		    return response()->json([
			    'Error' => 'invalid request'
		    ], Response::HTTP_NOT_FOUND);
	    }
	    return response()->json([
		    'Error' => 'invalid request'
	    ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        response()->json(["data" => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
