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

class AgentquoteAffiliate extends CustomModule {

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

	public function boot( $package ) {
		// TODO: Register it self as monitoring link by creating base_64 and sha1 of id
        // TODO: insert into user_module_monitor_links table
        // TODO: insert reference in user_module_hash_links table

        // dd(['AgentquoteAffiliate::boot', $userModule]);
        // $moduleData = json_decode( $userModule['data'], true );

        $userId = Auth::user()->id;

        if (CustomModuleUser::where([
            'user_id' => $userId,
            'custom_module_id' => $package['module']->id
        ])->exists()) {
            if ( ! $package['checked'] ) {
                return [ 'successful' => false, 'Module ' . $package['module']['name'] . ' is already installed. Are you sure you want to overwrite?'];
            }
        }

        $userModule = CustomModuleUser::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $package['module']->id
            ],
            ['data' => $package['parameters']]
        );

        $url = '/a/m?i=' . base64_encode( sha1($userModule['id']) );
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
            'custom_modules_user_id' => $userModule['id'],
            'hash_id' => sha1($userModule['id'])
        ]);

        UserModuleHashLink::create([
            'user_module_id' => $userModule['id'],
            'monitor_link_id' => $userModuleMonitorLink->id
        ]);

	}

	public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
	}

    public function onEdit( $package ) {
    }

    public function onUpdate( $package ) {

    }

    public function onRender( $package ) {

        $parameters = '';
        $hasDollar = strstr($package['config']['remote_site'], "?" );
        $first = true;
        foreach($package['parameters'] as $param_key => $param_val) {
            if ($first) {
                if ($hasDollar) {
                    $parameters .=  "&";
                } else {
                    $parameters .=  "?";
                }
                $parameters .=  $param_key . '=' . urlencode( $package['parameters'][$param_key] );
                $first = false;
            } else {
                $parameters .=  "&" . $param_key . '=' . urlencode( $package['parameters'][$param_key] );
            }
        }

	    $url = $package['config']['remote_site'] . $parameters;
        $title = 'Agent Quote Affiliate Link';
	    // echo $url;
        $view = View::make('custom_modules.agentquote_affiliate.render', compact('url' , 'title'));

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
