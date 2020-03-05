<?php

namespace App\CustomModules;

use App\Models\Line;
use App\Models\UserDomain;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Dzineer\CustomModules\Models\HashCustomModuleUser;
use Dzineer\CustomModules\Models\UserModuleHashLink;
use Dzineer\CustomModules\Models\UserModuleMonitorLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TermlifeModule extends CustomModule {

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
            ['data' => json_encode($data['parameters']) ]
        );

        $url = '/a/m?i=' . base64_encode( sha1($userModule->id) );
        $encodedURL = base64_encode( $url );

        // echo($encodedURL);

        $temp = UserModuleMonitorLink::where([ "encoded_url" => $encodedURL]);

        if( $temp->exists() ) {
            $temp->delete();
        }

        $userModuleMonitorLink = UserModuleMonitorLink::create([
            "encoded_url" => $encodedURL,
            "hash_id" => 0
        ]);

        $userModuleMonitorLink->hash_id = sha1( $userModuleMonitorLink->id );
        $userModuleMonitorLink->save();

        HashCustomModuleUser::create([
            'custom_modules_user_id' => $userModule->id,
            'hash_id' => sha1($userModule->id)
        ]);

        UserModuleHashLink::create([
            'user_module_id' => $userModule->id,
            'monitor_link_id' => $userModuleMonitorLink->id
        ]);

	}

	public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
	}

    public function onEdit( $module, $data ) {
        $domains = UserDomain::where([ 'user_id' => auth()->id(), "active" => 1])->get()->pluck('domain');

        if (!$domains) {
            $domains = [];
        }

        return view('custom_modules.termlife_module.settings', ['customModule' => $module, 'customModuleData' => json_encode($module), 'domains' => $domains]);
    }

    /**
     * @param $module
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function onAction( $module, $data ) {

    }

    public function onUpdate( $module, $data ) {

        $module->data =  $data;
        $module->save();

        return response()->json([
            "success" => true,
            "message" => 'Analytics Updated'
        ]);

    }

    public function onRender( $module, $data ) {

/*        $parameters = '';
        $hasDollar = strstr($data->config['remote_site'], "?" );
        $first = true;
        foreach($data['parameters'] as $param_key => $param_val) {
            if ($first) {
                if ($hasDollar) {
                    $parameters .=  "&";
                } else {
                    $parameters .=  "?";
                }
                $parameters .=  $param_key . '=' . urlencode( $data['parameters'][$param_key] );
                $first = false;
            } else {
                $parameters .=  "&" . $param_key . '=' . urlencode( $data['parameters'][$param_key] );
            }
        }*/

	    // $url = $data->config['remote_site'] . $parameters;
        // $title = 'Patrick Affiliate Link';
	    // echo $url;

/*        $title = preg_replace('/([a-z])([A-Z])/s','$1 $2', $oldstr);

        $data['parameters'] */

        return response()->json([
            "success" => true,
            "data" => [ "userModule" => $module, "config" => $data['config'], "parameters" => $data['parameters']]
        ]);

        $view = View::make('custom_modules.termlife_module.render', []);

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
            "onAction" => 'onAction',
        ];
    }
}
