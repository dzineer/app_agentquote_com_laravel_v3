<?php

namespace App\Http\Controllers;

use Dzineer\CustomModules\Facades\CustomModules;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

/**
 * Class UserCustomModulesController
 *
 * @package App\Http\Controllers
 */
class UserCustomModulesController extends Controller
{
    const ADMIN_SUPER_USER = 1;

    /**
     * @param $array
     * @param $key
     * @param $value
     *
     * @return |null
     */
    private function in_array_key_value($array, $key, $value)
    {
        foreach($array as $item) {
            if (key_exists($key, $item) &&  $item[$key] === $value) {
                return $item;
            }
        }
        return null;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $userId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(Request $request, $userId)
    {

        if ($request->has('module') ) {

            $customUserModule = CustomModules::getUserModule($request->input('module'), $userId);

            if (!$customUserModule) {
                return response()->json([
                    "success" => false,
                    "message" => "Module does not exist!",
                    "error" => "Module does not exist!"
                ]);
            }

            return CustomModules::customModuleRender( $customUserModule->module->module_name, $userId );

        } else {
            return response()->json([
                "success" => false,
                "message" => "Module does not exist!",
                "error" => "Module does not exist!"
            ]);
        }


    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dnd($request->all());

        if ($request->has('module') ) {

            if ($request->has('action') && $request->input('action') === 'add' ) {

                CustomModules::toggleUserModule($request->input('module'), Auth::user()->id);
                return redirect()->to(url()->current().'?'.http_build_query($request->except("action")));

            } else if ($request->has('action') && $request->input('action') === 'render' ) {

                $customModuleUser = CustomModules::getUserModule($request->input('module'), Auth::user()->id);
                return CustomModules::onHook( 'onRender', $customModuleUser->module->module_name, $customModuleUser['data'] );

            } else if ($request->has('action') && $request->input('action') === 'action' ) {

                $customModuleUser = CustomModules::getUserModule($request->input('module'), Auth::user()->id);
                return CustomModules::onHook( 'onAction', $customModuleUser->module->module_name, $customModuleUser['data'] );

            }
            else {
                return $this->moduleSettings($request->input('module'));
            }

        }

        $modules = CustomModules::getAdminModules(1);
        $user_modules = CustomModules::getUserModules(Auth::user()->id)->toArray();

        $new_modules = [];

        // does user have module ?
        foreach( $modules as $module ) {

            if ($module->module_type->type !== 'app_module') {

                $mod['id'] = $module['id'];
                $mod['name'] = $module['name'];
                $mod['module_name'] = $module['module_name'];
                $mod['module_image'] = $module['module_image'];
                $mod['module_display_image'] = $module['module_display_image'];
                $mod['description'] = $module['description'];
                $mod['module_type_id'] = $module['module_type_id'];
                $mod['featured'] = $module['featured'];
                $mod['status'] = $module['status'];

                $mod['module_type'] = $module->module_type->toArray();

                $customModule = $this->in_array_key_value( $user_modules, 'custom_module_id', $module['id'] );

                if ( $customModule ) {
                    $mod['in'] = true;
                    $mod['custom_module_id'] = $customModule['id'];
                } else {
                    $mod['in'] = false;
                }
                $new_modules[] = $mod;
                unset($mod);
            }

        }

	    return view('custom_modules::custom_modules.user.index', ['modules' => $new_modules] );
    }

    /**
     * @param $moduleName
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function moduleSettings( $moduleName ) {

        $customModule = CustomModules::getUserModule( $moduleName, Auth::user()->id );

        $result =  CustomModules::editUserModuleData($customModule['id'], Auth::user()->id);

        if ($result) {
            return $result;
        } else {
            return view('custom_modules::custom_modules.user.settings', compact('customModule') );
        }

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
        $userModule = CustomModules::getUserModuleById( $id, Auth::user()->id );

     //   dd([$userModule, request()->all()]);

        if (!$userModule) {
            return response()->json([
                "error" => "Module does not exist!"
            ], 404);
        }

        if ($request->has('custom')) {
            $data = json_decode($request->input('custom'),true);
            $userModule['data'] = $data;
            $userModule->save();

        }

        $params = json_decode( $userModule['data'], true );

        foreach( $params  as $key => $val ) {
            if ( isset( $params[$key] ) && $request->has($key)) {
                $params[ $key ] = $request->input( $key );
            }
        }

        // dd($params);

        $userModule->data = json_encode( $params );

        $userModule->save();

        return back();

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $userId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_custom_modules(Request $request, $userId)
    {
        if ( $request->has('module_type') ) {
            $customModules = CustomModules::getUserModules( $userId, $request->input('module_type') );
            $customModules = $customModules->map( function($customModule) {
               $customModule->parameters = json_decode( $customModule->data, true );
               $adminModule = CustomModules::getAdminModule( $customModule->module->module_name, self::ADMIN_SUPER_USER );
               $customModule->config = json_decode( $adminModule->data, true );
               return $customModule;
            });
        } else {
            $customModules = CustomModules::getUserModules( $userId );
            $customModules = $customModules->map( function($customModule) {
                // $customModule->config = json_decode( $customModule, true );
                $adminModule = CustomModules::getAdminModule( $customModule->module->module_name, self::ADMIN_SUPER_USER );
                $customModule->config = json_decode( $adminModule->data, true );
                return $customModule;
            });
        }
        return response()->json([ 'customModules' => $customModules, 'request' => $request->all() ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $customModule = CustomModules::getUserModuleById( $id, Auth::user()->id );

        $moduleId = $customModule->module->id;

        if ( $customModule->exists() ) {
            CustomModules::removeUserCustomModuleId( $moduleId, Auth::user()->id  );
            $customModule->delete();
        } else {
            return response()->json([
                "error" => "Invalid request"
            ]);
        }

        return redirect()->route('custom.user.modules.index');
    }

}
