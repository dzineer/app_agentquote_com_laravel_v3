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

/**
 * Class GoogleAnalyticsModule
 *
 * @package App\CustomModules
 */
class GoogleAnalyticsModule extends CustomModule {
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
            if ( ! $data->checked ) {
                return [ 'successful' => false, 'Module ' . $module->name . ' is already installed. Are you sure you want to overwrite?'];
            }
        }

        // dd([$userId,$module->id, $data['parameters'] ]);

        CustomModuleUser::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $module->id
            ],
            ['data' => json_encode($data['parameters']) ]
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
     * @param $package
     *
     * @return string
     */
    public function onAdminEdit( $module, $package ) {
        return "GoogleAnalytics::onAdminEdit";
    }

    /**
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function onUpdate( $module, $data ) {
       // dd([$module->data, $data]);
        $module->data =  $data;
        $module->save();
/*        CustomModuleUser::find($module->id)->update([
            "data" => $data
        ]);*/
        // dd([$module->data, $data]);

/*        return response()->json([
            "success" => true,
            "message" => $module
        ]);*/

        return response()->json([
            "success" => true,
            "message" => 'Analytics Updated'
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

            $domain = new \stdClass;
            $domain->type = 'text';
            $domain->value = '';

            $analytics_script = new \stdClass;
            $analytics_script->type = 'textarea';
            $analytics_script->value = '';

            $newData[] = [ "domain" => $domain, "analytics" => $analytics_script ];

            // $package['module']['data'] = json_encode([]);
            // $package['module']->save();
        }

        // dnd($package['module']['user_id']);

        $domains = CustomModules::getUserDomains( $module->user_id );

        // dd($domains);

       // dd($domains);

        if ($domains === null) {
            $domains = [];
        }

        // dd(["customModule" => $module, "customModuleData" => json_encode($module), "domains" => json_encode($domains) ] );

        return view('custom_modules.google_analytics_module.settings', ["customModule" => $module, "customModuleData" => json_encode($module), "domains" => json_encode($domains) ] );
    }

    /**
     * @param $package
     *
     * @return string
     */
    public function onAdminUpdate( $package ) {
        return "GoogleAnalytics::onAdminUpdate";
    }

    /**
     * @param $module
     * @param $package
     *
     * @return string
     */
    public function onRender( $module, $package ) {

        // dnd([$userModule, $package]);

/*        return response()->json([
            "success" => true,
            "data" => $data
        ]);*/

        // dnd([$package['parameters'][1]['domain']['value']]);

        foreach($package['parameters'] as $item) {
            if ($item['domain']['value'] === $package['host']) {
                $ga_code = $item['analytics']['value'];
                $view = View::make('custom_modules.google_analytics_module.render', ['ga_code' => $ga_code ]);
                $contents = $view->render();
                return $contents;
            }
        }

	    return '';
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
        ];
    }
}
