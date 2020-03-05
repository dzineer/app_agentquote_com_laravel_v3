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

class PageSectionModule extends CustomModule {

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

        $config = json_decode($module->data, true);

        CustomModuleAdmin::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $module->id
            ],
            ['data' => json_encode($config['config'])]
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

    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    public function onAdminEdit( $module, $data ) {
        // echo 'Admin Edit'; exit;
        $config = json_decode(json_decode($data,true),true);

        $newData = [];

        if ($config['code'] === null) {
            $newData['section'] = $config['section'];
            $newData['code'] = '';
        } else {
            $newData['section'] = $config['section'];
            $newData['code'] = $config['code'];
        }

        $newModule = new \stdClass();
        $newModule->id = $module->id;
        $newModule->module_name = $module->module->module_name;
        $newModule->config = $newData;

        $module['config'] = json_encode($newData);

        // dd($newModule);

        return view('custom_modules.page_section_module.settings', [ "customModule" => $module, "url" => "/api/app_module?module=page_section_module", "customModuleData" => json_encode($newModule) ] );
    }

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
        return "PageSection::onAdminUpdate";
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

    public function onAction( $module, $data ) {

/*        dd([
            "success" => true,
            "module" => $module,
            "data_new" => json_decode($data['options'],true),
        ]);*/

        if($data['action'] === 'update') {
            $config = json_decode($data['options'],true);
            $section = $config['section'];
            $code = $config['code'];

            $newData = [];
            $newData['section'] = $section;
            $newData['code'] = $code;

            $saveData = json_encode( $newData );

            CustomModuleAdmin::updateOrCreate([
                'id' => $config['module_id']
            ],[
               'data' =>  $saveData
            ]);

            return response()->json([
                "success" => true,
                "message" => 'Page section updated.'
            ]);

        }

        return response()->json([
            "success" => false,
            "message" => 'update failed.'
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
