<?php

namespace App\CustomModules;

use App\Models\Line;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class PageChoiceModule extends CustomModule {

    const ADMIN_SUPER_USER = 1;

    public function install( $module, $data ) {
        // TODO: Ran once to register as a installed admin module

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

    public function boot( $module, $data ) {
        // TODO: Register it self as monitoring link by creating base_64 and sha1 of id
        // TODO: insert into user_module_monitor_links table
        // TODO: insert reference in user_module_hash_links table

        // dd(['AgentquoteAffiliate::boot', $userModule]);
        // $moduleData = json_decode( $userModule['data'], true );

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

    public function onAction( $module, $data ) {

        if($data['action'] === 'load') {

            $config = json_decode($data['options'],true);

            // get the user's Page Choice Module
            $userPageChoiceModule = CustomModules::getUserModule( 'page_choice_module', $config['user_id'] );

            // Get all the User's Insurance Modules
            $customModules = CustomModules::getUserModules( $config['user_id'], 'insurance_module' );

            if (! ($userPageChoiceModule && $customModules )) {
                return response()->json([
                    'success' => false,
                    'message' => 'No insurance modules found.',
                ]);
            }

            // Get which modules to support
            $supportedModuleIds = json_decode( $userPageChoiceModule->data, true );

/*            return response()->json([
                'success' => true,
                'message' => $data,
                'supportedModuleIds' => $supportedModuleIds,
            ]);*/

            // get only the modules the User supports for the Page Choice Module
            $customModules = $customModules->filter( function($customModule) use($supportedModuleIds, $userPageChoiceModule) {
                return in_array($customModule->id, $supportedModuleIds);
            });

            $customModules = $customModules->map( function($customModule) {
                $customModule->config = json_decode( $customModule->data, true );
                $adminModule = CustomModules::getAdminModule( $customModule->module->module_name, self::ADMIN_SUPER_USER );
                $customModule->config = json_decode( $adminModule->data, true );
                return $customModule;
            })->toArray();

            return response()->json([
                'success' => true,
                'message' => $data,
                'customModules' => $customModules,
            ]);

        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid request.',
        ]);

    }

    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    public function onAdminEdit( $module, $package ) {
        return "GoogleAnalytics::onAdminEdit";
    }

    public function onUpdate( $module, $data ) {
        // dd([$module->data, $data]);
/*        return response()->json([
            "success" => false,
            "message" => $module->id
        ]);*/

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
        ]);*/

        CustomModuleUser::updateOrCreate([
            "id" => $module->id,
            "user_id" => $module->user_id
        ],[
            "data" => json_encode($modules)
        ]);

        return response()->json([
            "success" => true,
            "message" => 'Page choice updated.'
        ]);
    }

    public function onEdit( $module, $data ) {
        // dd([$module, $data]);
        if (!$data) {
            $newData = [];
        }

        $customModulesRecords = CustomModuleUser::where('user_id', $module->user_id);

        if ($customModulesRecords->exists()) {
            $customModules = $customModulesRecords->get();
            $customModulesRecords = $customModules->filter( function($customModule) {
               return $customModule->module->module_type->type === 'insurance_module';
            });
        }

        $supportTypeModules = [];

        foreach($customModulesRecords as $customRecord) {
            $supportTypeModules[] = [ "id" => $customRecord->id, "name" => trim(str_replace("Insurance Module", "", $customRecord->module->name)) ];
        }

        return view('custom_modules.page_choice_module.settings', ["customModule" => $module, "supportedCustomModules" => json_encode($supportTypeModules) ] );
    }

    public function onAdminUpdate( $module, $data  ) {
        return "GoogleAnalytics::onAdminUpdate";
    }

    public function onRender( $module, $data ) {

        // dnd([$userModule, $package]);

        /*        return response()->json([
                    "success" => true,
                    "data" => $data
                ]);*/

        // dnd([$package['parameters'][1]['domain']['value']]);

        return response()->json([
            "success" => true,
            "data" => [ "userModule" => $module, "config" => $data['parameters'] ]
        ]);

        return json_encode([
            "success" => true,
            "message" => "Domain not found!"
        ]);
    }

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
