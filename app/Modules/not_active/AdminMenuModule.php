<?php

namespace App\CustomModules;

use App\Facades\AQLog;
use App\Models\Line;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use App\Modules\WHMCSModule\Factories\WHMCSAPIRequestFactory;

class AdminMenuModule extends CustomModule {
    const ADMIN_SUPER_USER = 1;

    public function onAdminRenderMenu( $module, $data ) {
        return [
                    [
                        'text' => 'Dashboard',
                        'url'  => 'dashboard',
                        'icon' => 'dashboard'
                    ],
                    [
                        'text' => 'Users',
                        'icon' => 'users',
                        'submenu' => [
                            [
                                'text' => 'Affiliates',
                                'url'  => 'affiliates',
                                'icon' => 'blank'
                            ],
                            [
                                'text' => 'Agents',
                                'url'  => 'agents',
                                'icon' => 'blank'
                            ]
                        ],
                    ],
                    [
                        'text' => 'Ad',
                        'url'  => 'super/ad',
                        'icon' => 'users'
                    ],
                    [
                        'text' => 'Modules',
                        'url'  => '/modules',
                        'icon' => 'puzzle-piece',
                        'submenu' => [
                            [
                                'text' => 'List',
                                'url'  => 'modules/',
                                'icon' => 'blank'
                            ],
                            [
                                'text' => 'Install',
                                'url'  => 'modules/add',
                                'icon' => 'blank'
                            ],

                        ],
                    ],
                    [
                        'text' => 'WHMCS',
                        'icon' => 'users',
                        'submenu' => [
                            [
                                'text' => 'Clients',
                                'url'  => 'whmcs/clients',
                                'icon' => 'blank'
                            ],
                            [
                                'text' => 'Products',
                                'url'  => 'whmcs/products',
                                'icon' => 'blank'
                            ],
                        ],
                    ],
                ];
    }

    public function onRenderMenu( $module, $data ) {

    }

    public function onAction( $module, $data ) {

    }

    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    public function onUpdate( $module, $data ) {

        $modulesData = json_decode($data, true);

        $modules = [];

        foreach( $modulesData as $moduleData ) {
            if ($moduleData["checked"] === true) {
                $modules[] = $moduleData["module_id"];
            }
        }

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

    public function onAdminEdit( $module, $package ) {
        return "AdminMenuModule::onAdminEdit";
    }

    public function onRender( $module, $data ) {

        return response()->json([
            "success" => true,
            "data" => [ "userModule" => $module, "config" => $data['parameters'] ]
        ]);

    }

    public function getMethods() {
        return [

        ];
    }

    public function getHooks() {
        return [
            "onInstall" => 'install',
            "onRenderMenu" => 'onRenderMenu',
            "onAdminRenderMenu" => 'onAdminRenderMenu',
            "onAdminUpdate" => 'onAdminUpdate',
            "onAdminEdit" => 'onAdminEdit',
            "onRender" => 'onRender',
            "onAction" => 'onAction',
        ];
    }
}
