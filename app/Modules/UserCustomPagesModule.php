<?php

namespace App\CustomModules;

use App\Facades\AQLog;
use App\Models\BackupUserCustomPage;
use App\Models\Line;
use App\Models\Page;
use App\Models\UserCustomPage;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class UserCustomPagesModule extends CustomModule {

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

        // dnd([$module, $data]);

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

        // $originalPages = Page::all();

        return $config;

        foreach($originalPages as $page) {
            // dnd($page);
            $userPageCreated = UserPage::updateOrCreate([
                'user_id' => $userId,
                'id' => $page->id
            ],
             $page->toArray()
            );

            // dnd($userPageCreated);

            $originalPageSections = PageSection::where('id', $page->id)->get();

            foreach($originalPageSections as $userPageSection) {
                UserPageSection::updateOrCreate([
                    'user_id' => $userId,
                    'page_id' => $userPageSection->page_id,
                    'section_id' => $userPageSection->section_id,
                ],
                    $userPageSection->toArray()
                );
            }

        }

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
        $config = json_decode($data,true);
        // dd($config);
        $newModule = new \stdClass();
        $newModule->id = $module->id;
        $newModule->module_name = $module->module->module_name;

        $userId = Auth::user()->id;

        // dnd([$newModule, $config]);

        if ( isset( $config['new'] ) ) {
            $data = [ "customModule" => $module, "page_id" => 0, "name" => "", "url_path" => "", "user_id" => $userId, "css_class" => "page", "in_menu" => 0, "active" => 0, "url" => "/api/app_module?module=user_custom_pages_module", "moduleData" => "\"<div>new</div>\"",  "customModuleData" => json_encode($newModule) ];
            return view('custom_modules.user_custom_pages_module.section.settings', $data );
        }

        if ( isset( $config['page_id'] ) ) {

            // new section form
            if ( isset( $config['new'] ) ) {
                return view('custom_modules.user_custom_pages_module.section.settings', [ "customModule" => $module, "section" => "", "page_id" => $config['page_id'], "active" => 0, "in_menu" => 0, "css_class" => 'white', "section_id" => 0, "url" => "/api/app_module?module=user_custom_pages_module", "moduleData" => "",  "customModuleData" => json_encode($newModule) ] );
            }
            else {

                $page = UserCustomPage::where(['id' => $config['page_id']])->first()->toArray();

                // dnd($page);

                if ($page['data'] === null) {
                    $page['data'] = '';
                    $newData['class'] = 'page';
                    $newData['active'] = $page['active'];
                    $newData['in_menu'] = $page['in_menu'];
                } else {
                    $newData['active'] = $page['active'];
                    $newData['in_menu'] = $page['in_menu'];
                    $newData['class'] = $page['class'];
                    $newData['data'] = json_encode( base64_decode( $page['data'] ));
                }

                $data = [ "customModule" => $module, "page_id" => $page['id'], "name" => $page['name'], "url_path" => $page['url_path'], "user_id" => $userId, "css_class" => $newData['class'], "in_menu" => $page['in_menu'], "active" => $page['active'], "url" => "/api/app_module?module=user_custom_pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ];

/*

^ array:12 [▼
  "id" => 14
  "user_id" => 0
  "data" => "null"
  "render" => 1
  "class" => " "
  "base_class" => "page"
  "active" => 1
  "created_at" => "2020-02-19 16:51:20"
  "updated_at" => "2020-02-19 16:50:53"
  "in_menu" => 0
  "url_path" => "products-services/life-insurance"
  "locked" => 0
]
^ array:9 [▼
  "customModule" => Dzineer\CustomModules\Models\CustomModuleAdmin {#609 ▶}
  "page_id" => 14
  "user_id" => 1
  "css_class" => " "
  "in_menu" => 0
  "active" => 1
  "url" => "/api/app_module?module=user_custom_pages_module"
  "moduleData" => false
  "customModuleData" => "{"id":85,"module_name":"user_custom_pages_module"}"
]

*/

            //    dd( [ "data" => $data ] );

                return view('custom_modules.user_custom_pages_module.section.settings', $data );

            } 
        }

        $pages = UserCustomPage::get()->toArray();

        // dd($pages);

        // $pageModules = PageSection::get()->toArray();

        return view('custom_modules.user_custom_pages_module.settings', [ "customModule" => $module, "pages" => $pages, "url" => "/api/app_module?module=user_custom_pages_module", "customModuleData" => json_encode($newModule) ] );
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
        // echo 'Admin Edit'; exit;
        // dd($data);

        // return 'onEdit';
        // exit;

        $userId = Auth::user()->id;

        $config = json_decode($data,true);
        // dd($config);
        $newModule = new \stdClass();
        $newModule->id = $module->id;
        $newModule->module_name = $module->module->module_name;

        if ( isset( $config['new'] ) ) {
            return view('custom_modules.user_custom_pages_module.section.settings', [ "customModule" => $module, "name" => $config['name'], "page_id" => $config['page_id'], "user_id" => $userId, "active" => 0, "in_menu" => 0, "css_class" => 'white', "section_id" => 0, "url" => "/api/app_module?module=user_custom_pages_module", "moduleData" => "",  "customModuleData" => json_encode($newModule) ] );
        }

        if ( isset( $config['page_id'] ) ) {

            // new section form
            if ( isset( $config['new'] ) ) {
                return view('custom_modules.user_custom_pages_module.section.settings', [ "customModule" => $module, "name" => $config['name'], "page_id" => $config['page_id'], "user_id" => $userId, "active" => 0, "in_menu" => 0, "css_class" => 'white', "section_id" => 0, "url" => "/api/app_module?module=user_custom_pages_module", "moduleData" => "",  "customModuleData" => json_encode($newModule) ] );
            }
            else if ( isset( $config['page_id'] ) ) {


                $section = UserCustomPage::where(['id' => $config['page_id'], 'user_id' => $userId, 'section_id' => $config['section_id']])->first()->toArray();

                // dd($section);

                if ($section['data'] === null) {
                    $newData['section'] = $section['section'];
                    $newData['data'] = '';
                    $newData['class'] = 'bg-alabaster';
                    $newData['active'] = $section['active'];
                    $newData['in_menu'] = $section['in_menu'];
                } else {
                    $newData['section'] = $section['section'];
                    $newData['active'] = $section['active'];
                    $newData['in_menu'] = $section['in_menu'];
                    $newData['class'] = $section['class'];
                    $newData['data'] = json_encode( base64_decode( $section['data'] ));
                }

                // dd([ "customModule" => $module, "section" => $newData['section'], "page_id" => $section['page_id'], "section_id" => $section['section_id'], "url" => "/api/app_module?module=user_custom_pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ]);

                return view('custom_modules.user_custom_pages_module.section.settings', [ "customModule" => $module, "section" => $newData['section'], 'user_id' => $userId, "page_id" => $section['page_id'], "section_id" => $section['section_id'], "css_class" => $newData['class'], "in_menu" => $section['in_menu'], "active" => $section['active'], "url" => "/api/app_module?module=user_custom_pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ] );

            } else {

                // $section = UserPageSection::where(['page_id' => $config['page_id'], 'section_id' => $config['section_id']])->first()->toArray();
                // $sectionRecords = PageSection::where('page_id', $config['page_id'])->orderBy('position','asc');
                $sectionRecords = UserPageSection::where(['page_id' => $config['page_id'], 'user_id' => $userId])->orderBy('position','asc');

                $sections = [];
                $sections = [];

                if ($sectionRecords->exists()) {
                    $sections = $sectionRecords->get()->map( function( $section ) {
                        $newSection = [];
                        $newSection['section'] = ucfirst($section->section);
                        $newSection['page_id'] = $section->page_id;
                        $newSection['section_id'] = $section->section_id;
                        $newSection['active'] = $section->active;
                        return $newSection;
                    })->toArray();

                    return view('custom_modules.user_custom_pages_module.sections.settings', [ "customModule" => $module, "page" => $sections, 'user_id' => $userId, 'page_id' => $config['page_id'], "sections" => $sections,  "sectionsArray" => json_encode($sections), "url" => "/api/app_module?module=user_custom_pages_module", "customModuleData" => json_encode($newModule) ] );
                }

                // return view('custom_modules.user_custom_pages_module.sections.settings', [ "customModule" => $module, "page" => $sections, 'page_id' => $config['page_id'], "sections" => $sections, "url" => "/api/app_module?module=user_custom_pages_module", "customModuleData" => json_encode($newModule) ] );
            }
        }


        // dd($userId);

        $pages = UserPage::where('user_id', intval($userId))->get()->toArray();

        // dd($pages);

        // $pageModules = PageSection::get()->toArray();

        return view('custom_modules.user_custom_pages_module.settings', [ "customModule" => $module, "pages" => $pages, "user_id" => $userId, "url" => "/api/app_module?module=user_custom_pages_module", "customModuleData" => json_encode($newModule) ] );
    }

    public function onAdminUpdate( $module, $data  ) {
        return "UserPages::onAdminUpdate";
    }

    public static function getRoutes() {
        return UserCustomPage::where(['active' => 1])->get()->pluck('url_path');  
    }

    public static function renderPage($path) {
        $page = UserCustomPage::where(['url_path' => $path])->first();
        return view('custom-page', ['content' => base64_decode( $page->data )]);
    }

    public function onRender( $module, $data ) {

        $sectionsToRender = [];

        if (isset($data['arguments']['page_id'])) {

            $sections = UserPageSection::where('user_id', intval($data['arguments']['user_id']))
                                       ->where(['page_id' => $data['arguments']['page_id'], "render" => 1 ])
                                       ->where('active', 1 )
                                       ->orderBy('position','asc');

            if ($sections->exists()) {
                $sectionsToRender = $sections->get()->map(function($section) {
                    $newData = [];
                    $newData['data'] = base64_decode( $section['data'] );
                    $newData['base_class'] =  $section['base_class'];
                    $newData['class'] = $section['class'];
                    $newData['section'] = $section['section'];
                   // $newData['data'] = stripslashes( $newData['data'] );
                    return $newData;
                })->toArray();
            }

        }

        return $sectionsToRender;

    }

    public function onAction( $module, $data ) {

/*        dd([
            "success" => true,
            "module" => $module,
            "data_new" => json_decode($data['options'],true),
        ]);*/

        if($data['action'] === 'update') {
            $config = json_decode($data['options'],true);

            $saveCode = '';

//            AQLog::info("CONFIG: \n" . print_r($config,true));

            if ($config['page_id'] === 0) {

                $user_id = intval($config['user_id']);
                $page_id = intval($config['page_id']);

                if (isset($config['code'])) {
                    $saveCode = base64_encode($config['code']);
                }

                $active = 0;
                $in_menu = 0;

/*                 if ($info->exists()) {
                    $page = $info->get();
                    $new_page_id = $page[0]->id + 1;
                    $active = intval($config['active']);
                    $in_menu = intval($config['in_menu']);
                } else {
                    $new_page_id = 1;
                    $active = intval($config['active']);
                    $in_menu = intval($config['in_menu']);
                } */

                $pageData = UserCustomPage::create([
                    'user_id' => $user_id,
                    'name' => $config['name'],
                    'active' => $active,
                    'url_path' => $config['url_path'],
                    'in_menu' => $in_menu,
                    'data' =>  $saveCode,
                    'class' =>  $config['class'],
                ]);

/*                 $version = 1;

                if ($backup) {
                    $version = $backup->version;
                    $version = $version + 1;
                } */

                // dd(PageSection::find($pageSection->id)->toArray());
                // dd(PageSection::find($pageSection->id)->toArray());

/*                 $userCustomPageInsert = UserCustomPage::find($page->id)->toArray();
                
                unset($userCustomPageInsert['version']);

                $data = array_merge($userCustomPageInsert, ["version" => $version, "page_id" => $userCustomPageInsert['id']]);
                
                unset($data['id']);

                BackupUserCustomPage::create($data); */

                return response()->json([
                    "success" => true,
                    "message" => 'Page updated.'
                ]);

            }

            $updateInfo = [];

            // existing page

            /* if(isset($config['new_position']) && isset($config['old_position'])) {

                $prevUserSection = UserPageSection::where('user_id', intval($config['user_id']))
                                          ->where('page_id', intval($config['page_id']))
                                          ->where('position', intval($config['new_position']) )
                                          ->where('active', 1 )
                                          ->first();
                if ($prevUserSection) {

                    $newPosition = intval($config['new_position']);
                    $oldPosition = intval($config['old_position']);

                    AQLog::info("dragged item old position: " . $oldPosition);
                    AQLog::info("dragged item new position: " . $newPosition);

                    AQLog::info("item being replaced old position: " . $prevUserSection->position);
                    AQLog::info("item being replaced old new position: " . $oldPosition);

                    $newUserPositionedSection = UserPageSection::updateOrCreate([
                        'user_id' => intval($config['user_id']),
                        'page_id' => intval($config['page_id']),
                        'section_id' => intval($config['section_id'])
                    ],[
                      "position" => $newPosition
                    ]);

                    //  AQLog::info("new positioned section: " . print_r($newPositionedSection->toArray(),true));

                    $prevUserSectionRecord = PageSection::updateOrCreate([
                        'user_id' => intval($config['user_id']),
                        'page_id' => $prevUserSection->page_id,
                        'section_id' => $prevUserSection->section_id,
                    ],[
                        "position" => $oldPosition
                    ]);

                    // AQLog::info("previous section at new position: " . print_r($prevSectionRecord->toArray(),true));

                    return response()->json([
                        "success" => true,
                        "message" => 'Position updated.'
                    ]);

                }
            } */ 

                if ( isset($config['code']) ) {
                    $saveCode = base64_encode($config['code']);
                    $updateInfo['data'] = $saveCode;
                }

                if( isset($config['name']) ) {
                    $updateInfo['name'] = $config['name'];
                }

                if( isset($config['active']) ) {
                    $updateInfo['active'] = intval($config['active']);
                }

                if( isset($config['in_menu']) ) {
                    $updateInfo['in_menu'] = intval($config['in_menu']);
                }

                if( isset($config['class']) ) {
                    $updateInfo['class'] = $config['class'];
                }

                if( isset($config['url_path']) ) {
                    $updateInfo['url_path'] = $config['url_path'];
                }

                $customPage = UserCustomPage::updateOrCreate([
                    'id' => $config['page_id'],
                    'user_id' => $config['user_id'],
                ], $updateInfo);

/*                 return response()->json([
                    "success" => false,
                    "config" => $config,
                    "message" => $updateInfo,
                    "extra" => "updateInfo...",
                ]); */

                $backup = \DB::table('backup_user_custom_pages')->where('version', \DB::raw("(select max(`version`) from backup_user_custom_pages)"))
                                                                 ->where("user_id", $config['user_id'])
                                                                 ->where("page_id", $config['page_id'])
                                                                 ->first();

                $version = 1;

                if ($backup) {
                    $version = $backup->version;
                    $version = $version + 1;
                }

                // dd(UserPageSection::find($pageSection->id)->toArray());

                $userCustomPageInsert = UserCustomPage::find($customPage->id)->toArray();

                // unset($userCustomPageInsert['id']);
                unset($userCustomPageInsert['version']);
                $userCustomPageInsert['page_id'] = $userCustomPageInsert['id'];
                
/*                 return response()->json([
                    "success" => false,
                    "message" => $userCustomPageInsert
                ]); */

                $data = array_merge($userCustomPageInsert, ["version" => $version, "page_id" => $userCustomPageInsert['id']]);
                
                unset($data['id']);

                BackupUserCustomPage::create($data);

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
