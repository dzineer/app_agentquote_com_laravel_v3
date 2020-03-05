<?php

namespace App\CustomModules;

use App\Facades\AQLog;
use App\Models\BackupPageSection;
use App\Models\BackupUserPageSection;
use App\Models\Line;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\UserPage;
use App\Models\UserPageSection;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class UserPagesModule extends CustomModule {

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

        $originalPages = Page::all();

        foreach($originalPages as $page) {
            // dnd($page);
            $userPageCreated = UserPage::updateOrCreate([
                'user_id' => $userId,
                'id' => $page->id
            ],
             $page->toArray()
            );

            // dnd($userPageCreated);

            $originalPageSections = PageSection::where('page_id', $page->id)->get();

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

        if ( isset( $config['page_id'] ) ) {

            // new section form
            if ( isset( $config['new'] ) ) {
                return view('custom_modules.user_pages_module.section.settings', [ "customModule" => $module, "section" => "", "page_id" => $config['page_id'], "active" => 0, "in_menu" => 0, "css_class" => 'white', "section_id" => 0, "url" => "/api/app_module?module=user_pages_module", "moduleData" => "",  "customModuleData" => json_encode($newModule) ] );
            }
            else if ( isset( $config['section_id'] ) ) {

                $section = UserPageSection::where(['page_id' => $config['page_id'], 'section_id' => $config['section_id']])->first()->toArray();

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

                // dd([ "customModule" => $module, "section" => $newData['section'], "page_id" => $section['page_id'], "section_id" => $section['section_id'], "url" => "/api/app_module?module=user_pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ]);

                return view('custom_modules.user_pages_module.section.settings', [ "customModule" => $module, "section" => $newData['section'], "page_id" => $section['page_id'], "section_id" => $section['section_id'], "css_class" => $newData['class'], "in_menu" => $section['in_menu'], "active" => $section['active'], "url" => "/api/app_module?module=user_pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ] );

            } else {

                $sectionRecords = UserPageSection::where('page_id', $config['page_id'])->orderBy('position','asc');

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

                    return view('custom_modules.user_pages_module.sections.settings', [ "customModule" => $module, "page" => $sections, 'page_id' => $config['page_id'], "sections" => $sections,  "sectionsArray" => json_encode($sections), "url" => "/api/app_module?module=user_pages_module", "customModuleData" => json_encode($newModule) ] );
                }

                // return view('custom_modules.user_pages_module.sections.settings', [ "customModule" => $module, "page" => $sections, 'page_id' => $config['page_id'], "sections" => $sections, "url" => "/api/app_module?module=user_pages_module", "customModuleData" => json_encode($newModule) ] );
            }
        }

        $pages = Page::get()->toArray();

        // dd($pages);

        // $pageModules = PageSection::get()->toArray();

        return view('custom_modules.user_pages_module.settings', [ "customModule" => $module, "pages" => $pages, "url" => "/api/app_module?module=user_pages_module", "customModuleData" => json_encode($newModule) ] );
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

        if ( isset( $config['page_id'] ) ) {

            // new section form
            if ( isset( $config['new'] ) ) {
                return view('custom_modules.user_pages_module.section.settings', [ "customModule" => $module, "section" => "", "page_id" => $config['page_id'], "user_id" => $userId, "active" => 0, "in_menu" => 0, "css_class" => 'white', "section_id" => 0, "url" => "/api/app_module?module=user_pages_module", "moduleData" => "",  "customModuleData" => json_encode($newModule) ] );
            }
            else if ( isset( $config['section_id'] ) ) {


                $section = UserPageSection::where(['page_id' => $config['page_id'], 'user_id' => $userId, 'section_id' => $config['section_id']])->first()->toArray();

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

                // dd([ "customModule" => $module, "section" => $newData['section'], "page_id" => $section['page_id'], "section_id" => $section['section_id'], "url" => "/api/app_module?module=user_pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ]);

                return view('custom_modules.user_pages_module.section.settings', [ "customModule" => $module, "section" => $newData['section'], 'user_id' => $userId, "page_id" => $section['page_id'], "section_id" => $section['section_id'], "css_class" => $newData['class'], "in_menu" => $section['in_menu'], "active" => $section['active'], "url" => "/api/app_module?module=user_pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ] );

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

                    return view('custom_modules.user_pages_module.sections.settings', [ "customModule" => $module, "page" => $sections, 'user_id' => $userId, 'page_id' => $config['page_id'], "sections" => $sections,  "sectionsArray" => json_encode($sections), "url" => "/api/app_module?module=user_pages_module", "customModuleData" => json_encode($newModule) ] );
                }

                // return view('custom_modules.user_pages_module.sections.settings', [ "customModule" => $module, "page" => $sections, 'page_id' => $config['page_id'], "sections" => $sections, "url" => "/api/app_module?module=user_pages_module", "customModuleData" => json_encode($newModule) ] );
            }
        }


        // dd($userId);

        $pages = UserPage::where('user_id', intval($userId))->get()->toArray();

        // dd($pages);

        // $pageModules = PageSection::get()->toArray();

        return view('custom_modules.user_pages_module.settings', [ "customModule" => $module, "pages" => $pages, "user_id" => $userId, "url" => "/api/app_module?module=user_pages_module", "customModuleData" => json_encode($newModule) ] );
    }

    public function onAdminUpdate( $module, $data  ) {
        return "UserPages::onAdminUpdate";
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

            // AQLog::info("CONFIG: \n" . print_r($config,true));

            if ($config['section_id'] === '0') {

                $user_id = intval($config['user_id']);
                $page_id = intval($config['page_id']);

                $info = \DB::table('user_page_sections')
                        ->where('section_id', \DB::raw("(select max(`section_id`) from user_page_sections)"))
                        ->where("use_id", $user_id)
                        >where("page_id", $page_id);

                if (isset($config['code'])) {
                    $saveCode = base64_encode($config['code']);
                }

                $active = 0;
                $in_menu = 0;

                $backup = \DB::table('backup_user_page_sections')->where('version', \DB::raw("(select max(`version`) from backup_user_page_sections)"))
                                                                 ->where("use_id", $user_id)
                                                                 ->where("page_id", $page_id)
                                                                 ->first();

                if ($info->exists()) {
                    $section = $info->get();
                    $new_section_id = $section[0]->section_id + 1;
                    $position = $section[0]->position + 1;
                    $active = intval($config['active']);
                    $in_menu = intval($config['in_menu']);
                } else {
                    $new_section_id = 1;
                    $position = 0;
                    $active = intval($config['active']);
                    $in_menu = intval($config['in_menu']);
                }

                $pageSection = UserPageSection::create([
                    'user_id' => $user_id,
                    'page_id' => $page_id,
                    'section_id' => $new_section_id,
                    'section' => $config['section'],
                    'position' => $position,
                    'active' => $active,
                    'in_menu' => $in_menu,
                    'data' =>  $saveCode,
                    'class' =>  $config['class'],
                ]);

                $version = 1;

                if ($backup) {
                    $version = $backup->version;
                    $version = $version + 1;
                }

                // dd(PageSection::find($pageSection->id)->toArray());
                // dd(PageSection::find($pageSection->id)->toArray());

                $userPageSectionInsert = UserPageSection::find($pageSection->id)->toArray();
                unset($userPageSectionInsert['id']);
                unset($userPageSectionInsert['version']);

                BackupUserPageSection::create(array_merge($userPageSectionInsert, ["version" => $version]));

                return response()->json([
                    "success" => true,
                    "message" => 'Page section updated.'
                ]);

            }

            $updateInfo = [];

            if(isset($config['new_position']) && isset($config['old_position'])) {

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
            } else {

                if ( isset($config['code']) ) {
                    $saveCode = base64_encode($config['code']);
                    $updateInfo['data'] = $saveCode;
                }

                if( isset($config['section']) ) {
                    $updateInfo['section'] = $config['section'];
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

                $pageSection = UserPageSection::updateOrCreate([
                    'user_id' => $config['user_id'],
                    'page_id' => $config['page_id'],
                    'section_id' => $config['section_id']
                ], $updateInfo);


                $backup = \DB::table('backup_user_page_sections')->where('version', \DB::raw("(select max(`version`) from backup_user_page_sections)"))
                                                                 ->where("user_id", $config['user_id'])
                                                                 ->where("page_id", $config['page_id'])
                                                                 ->first();

                $version = 1;

                if ($backup) {
                    $version = $backup->version;
                    $version = $version + 1;
                }

                // dd(UserPageSection::find($pageSection->id)->toArray());

                $pageSectionInsert = UserPageSection::find($pageSection->id)->toArray();
                unset($pageSectionInsert['id']);
                unset($pageSectionInsert['version']);

                BackupPageSection::create(array_merge($pageSectionInsert, ["version" => $version]));

                return response()->json([
                    "success" => true,
                    "message" => 'Page section updated.'
                ]);
            }
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
