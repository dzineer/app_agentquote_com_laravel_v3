<?php

namespace App\Http\Controllers\InsuranceModuleControllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiPageModuleController extends Controller
{
    public function page(Request $request) {

        // no matter what happens we need to receive a selected state abbreviation of two letters

        $data = $request->validate([
            'state' => 'required|string|min:2|max:2',
            'user_id' => 'required|integer'
        ]);

        $user = User::find($data['user_id']);

        if ( strtoupper($user->profile->contact_state) !== strtoupper($data['state']) ) {
            return response()->json([
                "error" => "State not found!",
                "extra" => $data['state'],
                "required" => strtoupper($user->profile->contact_state)
            ]);
        }

        $existingSession = false;
        $invalidPreviousModule = false;
        $previousFields = null;

        $allowedModules = config('insurance_modules.allowed_modules');
        $supportedForms = config('insurance_modules.supported_forms');
        $mainSessionKey = config('insurance_modules.main_session_key');

        $insureModule = [];

        // dd( Session::get( $mainSessionKey ) );

        // do we have a previous session ?
        if (Session::has( $mainSessionKey )) {
            $existingSession = true;
            $insureModule = json_decode( Session::get( $mainSessionKey ), true );
            // do we have a previous form ?
            if ( isset($insureModule[ $mainSessionKey ][ 'previous_insure_module' ]) ) {
                // get the previous module's fields
                $previousInsureModule = $insureModule[ $mainSessionKey ][ 'previous_insure_module' ];

                // prevent hacking and prevent invalid previous modules
                if (! in_array($previousInsureModule, $allowedModules)) {
                    $invalidPreviousModule = true;
                }

                if ( isset($insureModule[ $mainSessionKey ][ 'previous_insure_form' ]) ) {
                    $previousInsureForm = $insureModule[ $mainSessionKey ][ 'previous_insure_form' ];
                    if ( ! in_array($previousInsureForm, $supportedForms) ) {
                        $invalidPreviousModule = true;
                    }

                    // okay if we get here we can accept the previous form's fields
                    $previousFields = $insureModule[ $mainSessionKey ][ 'forms' ][ $previousInsureForm ][ 'fields' ];
                }

            }

        }

        // set a new session: if we don't have a current session or if we have an invalid session
        if ( ! $existingSession || $invalidPreviousModule ) {

            $insureModule = [];
            $insureModule[  $mainSessionKey ] = [];
            $insureModule[  $mainSessionKey ]['previous_insure_module'] = '';
            $insureModule[  $mainSessionKey ]['previous_insure_form'] = 'si';
            $insureModule[  $mainSessionKey ]['forms'] = [];
            $insureModule[  $mainSessionKey ]['forms']["si"] = [] ;
            $insureModule[  $mainSessionKey ]['forms']["si"]["fields"] = [] ;
            $insureModule[  $mainSessionKey ]['forms']["si"]["fields"]["state"] = $data['state'];
            $insureModule[  $mainSessionKey ]['security_info'] = [];
            $insureModule[  $mainSessionKey ]['security_info']['remote_ip_address'] = $request->ip();

            Session::put('landing_page_config', json_encode($insureModule) );
        }

        $data = config('landing_page.data');

        // dd(json_decode(json_encode($data['menus'])));

        $data['selected_state'] = $request->input('state');
        $data['user'] = $user;
        $data['insure_module'] = $insureModule;

        $data['insure_module']['module'] = 'si';

        // return view('landing-pages.v1.quote_modules.underwritten.index', $data);
        return view('landing-pages.v1.quote_modules.underwritten.index', $data);

    }
}
