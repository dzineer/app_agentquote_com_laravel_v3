<?php

namespace App\CustomModules;

use App\Models\Line;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Dzineer\CustomModules\Models\HashCustomModuleUser;
use Dzineer\CustomModules\Models\UserModuleHashLink;
use Dzineer\CustomModules\Models\UserModuleMonitorLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ChoiceModule implements CustomModule {

    public function install( $module, $data ) {
        // TODO: Ran once to register as a installed admin module

        // dd($data);

        $userId = Auth::user()->id;

        if (CustomModuleAdmin::where([
            'user_id' => $userId,
            'custom_module_id' => $module->id
        ])->exists()) {
            if ( ! $data->checked ) {
                return [ 'successful' => false, 'Module ' .$module->name . ' is already installed. Are you sure you want to overwrite?'];
            }
        }

        CustomModuleAdmin::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $module->id
            ],
            ['data' => $data->config]
        );

    }

    public function boot( $module, $data ) {
        // TODO: Register it self as monitoring link by creating base_64 and sha1 of id
        // TODO: insert into user_module_monitor_links table
        // TODO: insert reference in user_module_hash_links table

        // dd(['AgentquoteAffiliate::boot', $userModule]);
        // $moduleData = json_decode( $userModule['data'], true );

        $userId = Auth::user()->id;

        if (CustomModuleUser::where([
            'user_id' => $userId,
            'custom_module_id' => $module->id
        ])->exists()) {
            if ( ! $data->checked ) {
                return [ 'successful' => false, 'Module ' . $module->name . ' is already installed. Are you sure you want to overwrite?'];
            }
        }

        $userModule = CustomModuleUser::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $module->id
            ],
            ['data' => $data['parameters']]
        );

    }

    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    public function onEdit( $module, $data ) {
    }

    public function onUpdate( $module, $data ) {

    }

    public function onRender( $module, $data ) {

        return response()->json([
            "success" => true,
            "data" => $data
        ]);

        echo "<div>Menu Items</div>";

        // $view = View::make('custom_modules.page_choice_module.render', []);

        /// $contents = $view->render();

/*        return json_encode([
            "success" => true,
            "output" => $contents
        ]);*/
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
            "onUpdate" => 'onUpdate',
            "onEdit" => 'onEdit',
            "onRender" => 'onRender',
        ];
    }
}
