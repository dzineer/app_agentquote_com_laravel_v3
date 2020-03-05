<?php

namespace App\CustomModules;

use App\Models\Line;
use App\Models\Page;
use App\Models\PageSection;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class PageMenuModule extends CustomModule {

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

    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    public function onRender( $module, $data ) {

        // return $data['arguments'];

        if (isset($data['arguments']['page_id'])) {

            $page = 'home';

            if (isset($data['arguments']['page'])) {
                $page = $data['arguments']['page'];
            }

            $pageSectionRecord = PageSection::where(['page_id' => $data['arguments']['page_id'], "in_menu" => 1])->orderBy('position','asc');

            if ($pageSectionRecord->exists()) {

                $pageSections = $pageSectionRecord->get();
                $menuData =  $pageSections->map( function($pageSection)  use($page) {
                    return [
                        'label' => ucfirst($pageSection->section),
                        'name' => $pageSection->section,
                        'link' => '#' . $pageSection->section,
                        'active' => $page === $pageSection->section
                    ];
                })->toArray();
                $data = [];
                $data['show'] = true;
                $data['default_menu'] = true;
                $data['main'] = $menuData;
                return $data;
            }

        }

        return [];
    }

    public function getMethods() {
        return [
            "POST" => [
            ],
            "GET" => [
            ]
        ];
    }

    public function getHooks() {
        return [
            "onInstall" => 'install',
            "onBoot" => 'boot',
            "onRender" => 'onRender'
        ];
    }
}
