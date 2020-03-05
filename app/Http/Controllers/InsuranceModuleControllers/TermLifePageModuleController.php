<?php

namespace App\Http\Controllers\InsuranceModuleControllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\User;
use Dzineer\CustomModules\Facades\CustomModules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TermLifePageModuleController extends Controller
{
    public function page(Request $request) {

        if ($request->has('customDomainLandingPage') && $request->input('customDomainLandingPage') === false) {
            if ($request->has('domain')) {

                return $this->byCustomDomain( $request );
            }
            else if ($request->has('subdomain')) {
                return $this->byVanitySubdomain( $request );
            }
        }
        else {
            return $this->byCustomDomain( $request );
        }


    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $data
     *
     * @return mixed
     */
    private function byVanitySubdomain( Request $request ) {

        $data = [];

        $subdomain              = $request->input( 'subdomain' );
        $user                   = User::find( $subdomain->user_id );
        $data['selected_state'] = $user->profile->contact_state;

        $existingSession       = false;
        $invalidPreviousModule = false;
        $previousFields        = null;

        $allowedModules = config( 'insurance_modules.allowed_modules' );
        $supportedForms = config( 'insurance_modules.supported_forms' );
        $mainSessionKey = config( 'insurance_modules.main_session_key' );

        $insureModule = [];

        if ( Session::has( $mainSessionKey ) ) {
            $existingSession = true;
            $insureModule    = json_decode( Session::get( $mainSessionKey ), true );
            // do we have a previous form ?
            if ( isset( $insureModule[ $mainSessionKey ]['previous_insure_module'] ) ) {
                // get the previous module's fields
                $previousInsureModule = $insureModule[ $mainSessionKey ]['previous_insure_module'];

                // prevent hacking and prevent invalid previous modules
                if ( ! in_array( $previousInsureModule, $allowedModules ) ) {
                    $invalidPreviousModule = true;
                }

                if ( isset( $insureModule[ $mainSessionKey ]['previous_insure_form'] ) ) {
                    $previousInsureForm = $insureModule[ $mainSessionKey ]['previous_insure_form'];
                    if ( ! in_array( $previousInsureForm, $supportedForms ) ) {
                        $invalidPreviousModule = true;
                    }

                    // okay if we get here we can accept the previous form's fields
                    $previousFields = $insureModule[ $mainSessionKey ]['forms'][ $previousInsureForm ]['fields'];
                }
            }
        }

        // set a new session: if we don't have a current session or if we have an invalid session
        if ( ! $existingSession || $invalidPreviousModule ) {

            $insureModule = $this->initInsureModule( $request->ip(), $mainSessionKey, $data['selected_state'] );
            Session::put( 'landing_page_config', json_encode( $insureModule ) );

        }

        $data = config( 'landing_page.data' );

        $data['social_media'] = $this->genSocialMediaDetails( $user );

        $data['ga_code'] = CustomModules::customModuleRender( 'google_analytics_module', $user['id'] );

        // dd(json_decode(json_encode($data['menus'])));

        $data['selected_state'] = $user->profile->contact_state;
        $data['user']           = $user;
        $data['insure_module']  = $insureModule;

        $data['insure_module']['module'] = 'underwritten';

        $data['version'] = 'v2';

        $data['menus'] = CustomModules::moduleRender( 'user_page_menu_module', [
            "page_id" => 2,
            "user_id" => $user->id
        ] );

        // get the user pages ... if none found then get the default pages
        if ( empty( $data['menus'] ) ) {
            $data['menus'] = CustomModules::moduleRender( 'page_menu_module', [ "page_id" => 2 ] );
        }

        $data['sections'] = CustomModules::moduleRender( 'user_pages_module', [
            "page_id" => 2,
            "user_id" => $user->id
        ] );
        // get the user pages ... if none found then get the default pages
        if ( empty( $data['sections'] ) ) {
            $data['sections'] = CustomModules::moduleRender( 'pages_module', [ "page_id" => 2 ] );
        }

        $options = [];
        $options['use_logo'] =  ! empty($user->profile->logo) || ! empty($user->profile->portrait) ;

        $company = $this->genCompanyDetails( $user->profile );

        // dd($company);

        $data['company'] = $company;
        $data['options'] = $options;
        $data['branding'] = $this->genBranding( $user, $options['use_logo'], $data['version'] );

        $data['rel_path'] = 'landing-pages.v3.quote_modules.underwritten';
        $data['templates_path'] = 'templates/landing-pages/v3/';

        // dd($data);

        // return view( 'landing-pages.v3.quote_modules.underwritten.index', $data );
        return view( 'responsive', $data );
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    private function byCustomDomain( Request $request ) {

        $data = $request->validate( [
            'state'   => 'string|min:2|max:2',
            'user_id' => 'sometimes|integer'
        ] );

        $user = null;
        $domain = null;

        $data = config( 'landing_page.data' );

        if ($request->has('domain')) {
            $domain =  $request->input('domain');
            $user = User::find( $domain['user_id'] );
        } else if ( $request->has( 'user_id' ) ) {
            $user = User::find( $data['user_id'] );
        }

       // dd($domain);

        if ( $request->has( 'state' ) && strtoupper( $user->profile->contact_state ) === strtoupper( $request->input( 'state' ) ) ) {

            $data['selected_state'] = $request->input( 'state' );
            /*            return response()->json([
                            "error" => "State not found!",
                            "extra" => $data['state'],
                            "required" => strtoupper($user->profile->contact_state)
                        ]);*/
        } else {
            $data['selected_state'] = $user->profile->contact_state;
        }

        $existingSession       = false;
        $invalidPreviousModule = false;
        $previousFields        = null;

        $allowedModules = config( 'insurance_modules.allowed_modules' );
        $supportedForms = config( 'insurance_modules.supported_forms' );
        $mainSessionKey = config( 'insurance_modules.main_session_key' );

        $insureModule = [];

        // dd( Session::get( $mainSessionKey ) );

        // do we have a previous session ?
        if ( Session::has( $mainSessionKey ) ) {
            $existingSession = true;
            $insureModule    = json_decode( Session::get( $mainSessionKey ), true );
            // do we have a previous form ?
            if ( isset( $insureModule[ $mainSessionKey ]['previous_insure_module'] ) ) {
                // get the previous module's fields
                $previousInsureModule = $insureModule[ $mainSessionKey ]['previous_insure_module'];

                // prevent hacking and prevent invalid previous modules
                if ( ! in_array( $previousInsureModule, $allowedModules ) ) {
                    $invalidPreviousModule = true;
                }

                if ( isset( $insureModule[ $mainSessionKey ]['previous_insure_form'] ) ) {
                    $previousInsureForm = $insureModule[ $mainSessionKey ]['previous_insure_form'];
                    if ( ! in_array( $previousInsureForm, $supportedForms ) ) {
                        $invalidPreviousModule = true;
                    }

                    // okay if we get here we can accept the previous form's fields
                    $previousFields = $insureModule[ $mainSessionKey ]['forms'][ $previousInsureForm ]['fields'];
                }
            }
        }

        // set a new session: if we don't have a current session or if we have an invalid session
        if ( ! $existingSession || $invalidPreviousModule ) {

            $insureModule = $this->initInsureModule( $request->ip(), $mainSessionKey, $data['selected_state'] );
            Session::put( 'landing_page_config', json_encode( $insureModule ) );
        }



        $data['social_media'] = $this->genSocialMediaDetails( $user );
        $data['ga_code'] = CustomModules::customModuleRender( 'google_analytics_module', $user['id'] );

        // dd(json_decode(json_encode($data['menus'])));

        // $data['selected_state'] = $request->input( 'state' );
        $data['user']           = $user;
        $data['insure_module']  = $insureModule;

        $data['insure_module']['module'] = 'underwritten';

        $data['version'] = 'v2';

        $data['menus'] = CustomModules::moduleRender( 'user_page_menu_module', [
            "page_id" => 2,
            "user_id" => $user->id
        ] );

        // get the user pages ... if none found then get the default pages
        if ( empty( $data['menus'] ) ) {
            $data['menus'] = CustomModules::moduleRender( 'page_menu_module', [ "page_id" => 2 ] );
        }

        $data['sections'] = CustomModules::moduleRender( 'user_pages_module', [
            "page_id" => 2,
            "user_id" => $user->id
        ] );
        // get the user pages ... if none found then get the default pages
        if ( empty( $data['sections'] ) ) {
            $data['sections'] = CustomModules::moduleRender( 'pages_module', [ "page_id" => 2 ] );
        }

        $options = [];
        $options['use_logo'] =  ! empty($user->profile->logo) || ! empty($user->profile->portrait) ;

        $company = $this->genCompanyDetails( $user->profile );

        // dd($company);

        $data['company'] = $company;
        $data['options'] = $options;
        $data['branding'] = $this->genBranding( $user, $options['use_logo'], $data['version'] );

        $data['rel_path'] = 'landing-pages.v3.quote_modules.underwritten';
        $data['templates_path'] = 'templates/landing-pages/v3/';

        return view( 'responsive', $data );
        return view( 'landing-pages.v3.quote_modules.underwritten.index', $data );
    }

    /**
     * @param $profile
     *
     * @return array
     */
    protected function genCompanyDetails( $profile ): array {
        return [
            'name' => $profile->company,

            'phone' => $profile->contact_phone,

            'email' => $profile->contact_email,

            'address' => $profile->contact_addr1 . ', ' .
                         $profile->contact_addr2 . ' ' .
                         $profile->contact_city . ', ' .
                         $profile->contact_state . ' ' .
                         $profile->contact_zip,
        ];
    }

    /**
     * @param $ip
     * @param $mainSessionKey
     * @param $defaultState
     *
     * @return array
     */
    private function initInsureModule( $ip, $mainSessionKey, $defaultState ) {
        $insureModule                                                          = [];
        $insureModule[ $mainSessionKey ]                                       = [];
        $insureModule[ $mainSessionKey ]['previous_insure_module']             = '';
        $insureModule[ $mainSessionKey ]['previous_insure_form']               = 'underwritten';
        $insureModule[ $mainSessionKey ]['forms']                              = [];
        $insureModule[ $mainSessionKey ]['forms']["underwritten"]                        = [];
        $insureModule[ $mainSessionKey ]['forms']["underwritten"]["fields"]              = [];
        $insureModule[ $mainSessionKey ]['forms']["underwritten"]["fields"]["state"]     = $defaultState;
        $insureModule[ $mainSessionKey ]['security_info']                      = [];
        $insureModule[ $mainSessionKey ]['security_info']['remote_ip_address'] = $ip;

        return $insureModule;
    }

    /**
     * @param $user
     *
     * @param $useLogo
     * @param $version
     *
     * @return array
     */
    private function genBranding( $user, $useLogo, $version ): array {

        $default_logo = asset_prepend('templates/landing-pages/' . $version . '/', 'images/logo-200x40.png');

        $imageUsed = $user->profile->portrait ? '/storage/' . $user->profile->portrait : '/storage/' . $user->profile->logo;

        $branding                  = [];
        $branding['company']       = $user->profile->company;
        $branding['logo']['light'] = $useLogo ? $imageUsed : '';
        $branding['logo']['dark']  = '';
        $branding['special_text']  = 'We provide a full spectrum of mobile quoters and web applications for insurance agents. Focusing on Life insurance, Health, Financial Advisors, and P&C. Our quoters and website applications cover all stages of the program development life cycle and keep you one step ahead of the competition.';
        $branding['copyright']     = 'Agent Quote Inc.';

        return $branding;
    }

    /**
     * @param $user
     * @param $data
     *
     * @return mixed
     */
    private function genSocialMediaDetails( $user ) {

        $socialMedia = [];

        if ( $user->profile->facebook_link && strlen( $user->profile->facebook_link ) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-facebook', 'link' => $user->profile->facebook_link ];
        }

        if ( $user->profile->twitter_link && strlen( $user->profile->twitter_link ) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-twitter', 'link' => $user->profile->twitter_link ];
        }

        if ( $user->profile->youtube_link && strlen( $user->profile->youtube_link ) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-youtube', 'link' => $user->profile->youtube_link ];
        }

        if ( $user->profile->linkedin_link && strlen( $user->profile->linkedin_link ) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-linkedin', 'link' => $user->profile->linkedin_link ];
        }

        if ( $user->profile->instagram_link && strlen( $user->profile->instagram_link ) ) {
            $socialMedia[] = [
                'name' => 'facebook',
                'icon' => 'fa-instagram',
                'link' => $user->profile->instagram_link
            ];
        }

        return json_encode( $socialMedia );

    }
}
