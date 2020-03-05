<?php

namespace App\CustomModules;

use App\Facades\AQLog;
use App\Models\BackupPageSection;
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

/**
 * Class PagesModule
 *
 * @package App\CustomModules
 */
class PagesModule extends CustomModule {
    /**
     * @param $module
     * @param $data
     *
     * @return array|mixed
     */
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

    /**
     * @param $module
     * @param $data
     *
     * @return array|mixed
     */
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

    /**
     * @return array|mixed
     */
    public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
    }

    /**
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
                return view('custom_modules.pages_module.section.settings', [ "customModule" => $module, "section" => "", "page_id" => $config['page_id'], "active" => 0, "in_menu" => 0, "css_class" => 'white', "section_id" => 0, "url" => "/api/app_module?module=pages_module", "moduleData" => "",  "customModuleData" => json_encode($newModule) ] );
            }
            else if ( isset( $config['section_id'] ) ) {

                $section = PageSection::where(['page_id' => $config['page_id'], 'section_id' => $config['section_id']])->first()->toArray();

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

                // dd([ "customModule" => $module, "section" => $newData['section'], "page_id" => $section['page_id'], "section_id" => $section['section_id'], "url" => "/api/app_module?module=pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ]);

                return view('custom_modules.pages_module.section.settings', [ "customModule" => $module, "section" => $newData['section'], "page_id" => $section['page_id'], "section_id" => $section['section_id'], "css_class" => $newData['class'], "in_menu" => $section['in_menu'], "active" => $section['active'], "url" => "/api/app_module?module=pages_module", "moduleData" => $newData['data'],  "customModuleData" => json_encode($newModule) ] );

            } else {

                $sectionRecords = PageSection::where('page_id', $config['page_id'])->orderBy('position','asc');

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

                    return view('custom_modules.pages_module.sections.settings', [ "customModule" => $module, "page" => $sections, 'page_id' => $config['page_id'], "sections" => $sections,  "sectionsArray" => json_encode($sections), "url" => "/api/app_module?module=pages_module", "customModuleData" => json_encode($newModule) ] );
                }

                // return view('custom_modules.pages_module.sections.settings', [ "customModule" => $module, "page" => $sections, 'page_id' => $config['page_id'], "sections" => $sections, "url" => "/api/app_module?module=pages_module", "customModuleData" => json_encode($newModule) ] );
            }
        }

        $pages = Page::get()->toArray();

        // dd($pages);

        // $pageModules = PageSection::get()->toArray();

        return view('custom_modules.pages_module.settings', [ "customModule" => $module, "pages" => $pages, "url" => "/api/app_module?module=pages_module", "customModuleData" => json_encode($newModule) ] );
    }

    /**
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

        return view('custom_modules.pages_module.settings', ["customModule" => $module, "supportedCustomModules" => json_encode($supportTypeModules) ] );
    }

    /**
     * @param $module
     * @param $data
     *
     * @return string
     */
    public function onAdminUpdate( $module, $data  ) {
        return "Pages::onAdminUpdate";
    }

    /**
     * @param $module
     * @param $data
     *
     * @return array
     */
    public function onRender( $module, $data ) {

        $sectionsToRender = [];

        if (isset($data['arguments']['page_id'])) {

            $sections = PageSection::where(['page_id' => $data['arguments']['page_id'], "render" => 1 ])
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

    /**
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

                $page_id = intval($config['page_id']);

                $info = \DB::table('page_sections')->where('section_id', \DB::raw("(select max(`section_id`) from page_sections)"))->where("page_id", $page_id);

                if (isset($config['code'])) {
                    $saveCode = base64_encode($config['code']);
                }

                $active = 0;
                $in_menu = 0;

                $backup = \DB::table('backup_page_sections')->where('version', \DB::raw("(select max(`version`) from backup_page_sections)"))->where("page_id", $page_id)->first();

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

                $pageSection = PageSection::create([
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

                $pageSectionInsert = PageSection::find($pageSection->id)->toArray();
                unset($pageSectionInsert['id']);
                unset($pageSectionInsert['version']);

                BackupPageSection::create(array_merge($pageSectionInsert, ["version" => $version]));

                return response()->json([
                    "success" => true,
                    "message" => 'Page section updated.'
                ]);

            }

            $updateInfo = [];

            if(isset($config['new_position']) && isset($config['old_position'])) {

                $prevSection = PageSection::where('page_id', intval($config['page_id']))
                                          ->where('position', intval($config['new_position']) )
                                          ->where('active', 1 )
                                          ->first();
                if ($prevSection) {

                    $newPosition = intval($config['new_position']);
                    $oldPosition = intval($config['old_position']);

                    AQLog::info("dragged item old position: " . $oldPosition);
                    AQLog::info("dragged item new position: " . $newPosition);

                    AQLog::info("item being replaced old position: " . $prevSection->position);
                    AQLog::info("item being replaced old new position: " . $oldPosition);

                    $newPositionedSection = PageSection::updateOrCreate([
                        'page_id' => intval($config['page_id']),
                        'section_id' => intval($config['section_id'])
                    ],[
                      "position" => $newPosition
                    ]);

                    //  AQLog::info("new positioned section: " . print_r($newPositionedSection->toArray(),true));

                    $prevSectionRecord = PageSection::updateOrCreate([
                        'page_id' => $prevSection->page_id,
                        'section_id' => $prevSection->section_id,
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

                $pageSection = PageSection::updateOrCreate([
                    'page_id' => $config['page_id'],
                    'section_id' => $config['section_id']
                ], $updateInfo);


                $backup = \DB::table('backup_page_sections')->where('version', \DB::raw("(select max(`version`) from backup_page_sections)"))->where("page_id", $config['page_id'])->first();

                $version = 1;

                if ($backup) {
                    $version = $backup->version;
                    $version = $version + 1;
                }

                // dd(PageSection::find($pageSection->id)->toArray());

                $pageSectionInsert = PageSection::find($pageSection->id)->toArray();
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

    /**
     * @return array|mixed
     */
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

    /**
     * @return array|mixed
     */
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
