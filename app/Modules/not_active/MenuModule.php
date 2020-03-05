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

class MenuModule extends CustomModule  {

    public function install( $package ) {
        // TODO: Ran once to register as a installed admin module

        // dd($data);

        $userId = Auth::user()->id;

        if (CustomModuleAdmin::where([
            'user_id' => $userId,
            'custom_module_id' => $package['module']->id
        ])->exists()) {
            if ( ! $package['checked'] ) {
                return [ 'successful' => false, 'Module ' . $package['module']['name'] . ' is already installed. Are you sure you want to overwrite?'];
            }
        }

        CustomModuleAdmin::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $package['module']->id
            ],
            ['data' => $package['config']]
        );

    }

    // not used with agent
    // super user only
    public function boot( $package ) {
        // TODO: Register it self as monitoring link by creating base_64 and sha1 of id
        // TODO: insert into user_module_monitor_links table
        // TODO: insert reference in user_module_hash_links table
    }

    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    public function onEdit( $request ) {
    }

    public function onUpdate( $request ) {

    }

    public function onRender( $data ) {
        // foreach($data['parameters'] as $param_key => $param_val)
        $parameters = '';
        $first = true;

        $menu =  $data['parameters']['menu'];

        // echo $url;
        $view = View::make('custom_modules.menu_module.render', compact('url' , 'title'));

        $contents = $view->render();

        return json_encode([
            "success" => true,
            "output" => $contents
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
            "onUpdate" => 'onUpdate',
            "onEdit" => 'onEdit',
            "onRender" => 'onRender',
        ];
    }
}
