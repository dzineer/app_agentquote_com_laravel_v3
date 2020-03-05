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

class WhmcsApiModule extends CustomModule {

    const ADMIN_SUPER_USER = 1;

    public function onMenu() {
        return [
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
        ];
    }

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

    public function onAction( $module, $data ) {

/*        return response()->json([
            'success' => false,
            'data' => $module,
        ]);*/

        if($data['action'] === 'GetClients') {

            $config = json_decode($data['options'],true);

            $page = 1;

            if (isset($config['page'])) {
                $page = $config['page'];
            }

            $api = WHMCSAPIRequestFactory::newClientsAPI();

            $response = $api->GetClients(0, 100, 'ASC', '', $page);

            $clients = [];

            if ( $response['success'] && isset($response['pagination']['next_page']) ) {
                $clients = $response['data'];
                $pageIndex = $response['pagination']['next_page'];
                $lastPage = $response['pagination']['last_page'];
                $limitStart = ($pageIndex * 10)+1;
                for( ; $page < $lastPage; $pageIndex++) {
                    $response2 = $api->GetClients($limitStart, 10, 'ASC', '', $pageIndex);
                    AQLog::network( "onAction returned response: " . json_encode([
                            "response2" => $response2
                        ],true));
                    if ( $response2['success'] ) {
                        $clients2 = $response2['data'];
                        $clients = array_merge($clients, $clients2);
                    }
                }
            }


            $users = \App\User::all()->pluck('id', 'email')->toArray();

            $filter = [
                'id',
                'email'
            ];

           // dd($response['data']);

            $whmcsUsers = array_map(function($user) {
                return ['id' => $user['id'], 'email' => $user['email'] ];
            }, $response['data']);

            $whmcsUsersUsers = \App\Models\WhmcsUserUser::all()->pluck('user_id', 'whmcs_user_id')->toArray();

            // AQLog::network( "onAction Response: " . print_r($response,true));

            if ( ! $response['success'] ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Request failed',
                ]);
            }

            AQLog::network( "onAction returned response: " . print_r([
                    'success' => true,
                    'clients' => $response['data'],
                    'whmcs_users' => $whmcsUsers,
                    'users' => $users,
                    'pagination' => $response['pagination']
                ],true));

            return response()->json([
                'success' => true,
                'clients' => $clients,
                'users' => $users,
                'whmcs_users_users' => $whmcsUsersUsers,
                'whmcs_users' => $whmcsUsers,
                'pagination' => $response['pagination']
            ]);

        }
        else if($data['action'] === 'GetProducts') {

            $config = json_decode($data['options'],true);

            $page = 1;

            if (isset($config['page'])) {
                $page = $config['page'];
            }

            $api = WHMCSAPIRequestFactory::newProductsAPI();

            $response = $api->GetProducts();

            // AQLog::network( "onAction Response: " . print_r($response,true));

            if ( ! $response['success'] ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Request failed',
                ]);
            }

            AQLog::network( "onAction returned response: " . print_r([
                    'success' => true,
                    'fields' => $response['fields'],
                    'products' => $response['data'],
                    'pagination' => $response['pagination']
                ],true));

            return response()->json([
                'success' => true,
                'fields' => $response['fields'],
                'products' => $response['data'],
                'pagination' => $response['pagination']
            ]);

        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid request',
        ]);

    }

    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
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

    public function onAdminEdit( $module, $package ) {
        return "GoogleAnalytics::onAdminEdit";
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
            "onUnInstall" => 'unInstall',
            "onBoot" => 'boot',
            "onMenu" => 'onMenu',
            "onAdminUpdate" => 'onAdminUpdate',
            "onUpdate" => 'onUpdate',
            "onAdminEdit" => 'onAdminEdit',
            "onEdit" => 'onEdit',
            "onRender" => 'onRender',
            "onAction" => 'onAction',
        ];
    }
}
