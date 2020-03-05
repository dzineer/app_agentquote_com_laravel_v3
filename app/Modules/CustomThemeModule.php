<?php
/**
* Handler is called to install custom module for super user.
* Install module for super user
* @author Franklin Decker III <frank@dzineer.com>
* @since 1.0
*
* @namespace App\CustomModules
*/

namespace App\CustomModules;

use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

/**
 * Class CustomThemeModule
 *
 * @package App\CustomModules
 */

class CustomThemeModule extends CustomModule {

    /**
     * Handler is called to install custom module for super user.
     *
     * @param $module
     * @param $data
     *
     * @return array|mixed
     */
    public function install( $module, $data ) {
        // TODO: Run once to register and/or install admin module

        // dd($data);

        $userId = Auth::user()->id;

        if (CustomModuleAdmin::where([
            'user_id' => $userId,
            'custom_module_id' => $module->id
        ])->exists()) {
            if ( ! $data['checked'] ) {
                return [ 'successful' => false, 'Module ' . $module->name . ' is already installed. Are you sure you want to overwrite?'];
            }
        }

        CustomModuleAdmin::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $module->id
            ],
            ['data' => $data['config']]
        );

    }

    /**
     * Handler is called to install the custom module for user.
     *
     * @param $module
     * @param $data
     *
     * @return array|mixed
     */
    public function boot( $module, $data ) {

        // dd([$module, $data]);

        $userId = Auth::user()->id;

        if (CustomModuleUser::where([
            'user_id' => $userId,
            'custom_module_id' => $module->id
        ])->exists()) {
            if ( ! $data['checked'] ) {
                return [ 'successful' => false, 'Module ' . $module->name . ' is already installed. Are you sure you want to overwrite?'];
            }
        }

        $config = json_decode($module->data, true);

       // dd($config);

        CustomModuleUser::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $module->id
            ],
            ['data' => json_encode($config['parameters'])]
        );

    }

    /**
     * Handler that provides the array of hooks this custom module supports.
     * @return array|mixed
     */
    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    /**
     * @param $module
     * @param $data
     *
     * @return string
     */
    public function onAdminUpdate( $module, $data  ) {
        return "CustomThemeModule::onAdminUpdate";
    }

    /**
     * Handler that is called when the Custom Module settings is being updated by user.
     *
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function onUpdate( $module, $data ) {
        // dd([$module->data, $data]);
        return response()->json([
            "success" => false,
            "message" => $module->id
        ]);

        $modulesData = json_decode($data, true);

        $modules = [];

        foreach( $modulesData as $moduleData ) {
            if ($moduleData["checked"] === true) {
                $modules[] = $moduleData["module_id"];
            }
        }

/*        return response()->json([
            "success" => false,
            "message" => $modules
        ]);
*/

        CustomModuleUser::updateOrCreate([
            "id" => $module->id,
            "user_id" => $module->user_id
        ],[
            "data" => json_encode($modules)
        ]);

        return response()->json([
            "success" => true,
            "message" => 'CustomThemeModule updated.'
        ]);
    }

    /**
     * Handler that is called when the Custom Module if being configured by user.
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function onEdit( $module, $data ) {
        // dd([$module, $data]);
        if (!$data) {
            $newData = [];
        }

        return view('custom_modules.custom_theme_module.settings', ["customModule" => json_encode($module) ] );
    }

    /**
     * Handler that is called when the Custom Module if being configured by super user.
     *
     * @param $module
     * @param $data
     *
     * @return string
     */
    public function onAdminEdit( $module, $data ) {

        $config = json_decode($data,true);
        // dd($config);
        $newModule = new \stdClass();
        $newModule->id = $module->id;
        $newModule->module_name = $module->module->module_name;

        return 'CustomThemeModule::onAdminEdit';
    }

    /**
     * This is called when an action variable is passed to the module
     * loader controller.
     *
     * Custom Module actions provide the interface for interacting with it.
     *
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function onAction( $module, $data ) {
       return response()->json([
           'success' => true,
           'message' => 'action taken'
       ]);
    }

    /**
     * Render Custom Module output
     *
     * @param $module
     * @param $data
     *
     * @return array
     */
    public function onRender( $module, $data ) {
        dd([$module, $data]);
    }

    /**
     * Provide which HTTP Methods this custom module supports.
     *
     * @return array|mixed
     */
    public function getMethods() {
        return [
            "POST" => [
                "fname",
                "lname",
            ],
            "GET" => [
                "id"
            ]
        ];
    }

    /**
     * Provide which hooks this custom module supports.
     * @return array|mixed
     */
    public function getHooks() {
        return [
            "onInstall" => 'install',
            "onBoot" => 'boot',
            "onAdminUpdate" => 'onAdminUpdate',
            "onUpdate" => 'onUpdate',
            "onAdminEdit" => 'onAdminEdit',
            "onEdit" => 'onEdit',
            "onRender" => 'onRender',
            "onAction" => 'onAction',
        ];
    }

}
