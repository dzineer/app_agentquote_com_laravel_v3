<?php

namespace App\CustomModules;

use App\Facades\AQLog;
use App\Models\Affiliate;
use App\Models\Line;
use App\Models\UserDomain;
use App\Modules\DomainsModule\DomainsActionDispatch;
use App\User;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class DomainsModule extends CustomModule {

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

    public function unInstall( $module, $data ) {
        // TODO: remove all installed items
        \App\Models\UserDomain::truncate();
    }

    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    public function onAdminEdit( $module, $data ) {
        // echo 'Admin Edit'; exit;
        $config = json_decode($data,true);
        // dd($config);
        $newModule = new \stdClass();
        $newModule->id = $module->id;
        $newModule->module_name = $module->module->module_name;

        if ( isset( $config['domain_id'] ) ) {

            // new section form
            if ( isset( $config['new'] ) ) {
                return view('custom_modules.domains_module.domains.settings', [ "customModule" => $module, "section" => "", "domain_id" => $config['domain_id'], "active" => 0, "url" => "/api/app_module?module=domains_module", "moduleData" => "",  "customModuleData" => json_encode($newModule) ] );
            }

        }

        // dd($pages);

        [ $domainsPaginationArr, $domainsData ] = $this->getDomainPagination();

        // array_merge([], $domainsData);

        // dd([ "pagination" => $domainsPaginationArr, "domains" => json_encode($domainsData) ]);

        return view('custom_modules.domains_module.domains.settings', [ "customModule" => $module, "domains" => json_encode($domainsData), "pagination" => json_encode($domainsPaginationArr), "url" => "/api/app_module?module=domains_module", "customModuleData" => json_encode($newModule) ] );
    }

    public function onAction( $module, $data ) {
       return response()->json(
           (new DomainsActionDispatch())->dispatch($data['action'], $data['options'])
       );
    }

    public function onAdminUpdate( $module, $data  ) {
        return "DomainsModule::onAdminUpdate";
    }

    public function onRender( $module, $data ) {
        dd([$module, $data]);
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
            "onAdminUpdate" => 'onAdminUpdate',
            "onAdminEdit" => 'onAdminEdit',
            "onRender" => 'onRender',
            "onAction" => 'onAction',
        ];
    }/**
 * @return array
 */
    private function getDomainPagination(): array {
        $domainsWithPagination = UserDomain::paginate();
        $domainsWithPagination->setPath( "/api/app_module?module=domains_module&action=list" );
        $domainsPaginationArr = $domainsWithPagination->toArray();
        $domainsData          = $domainsPaginationArr['data'];



        unset( $domainsPaginationArr['data'] );

        $domainsData = !! $domainsData ? $domainsData : [];

       // dd( $domainsData );

        return [ $domainsPaginationArr, $domainsData ];
    }
}
