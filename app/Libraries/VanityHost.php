<?php

namespace App\Libraries;
use Illuminate\Support\Facades\View;
use App\CustomModules\UserCustomPagesModule;
use Dzineer\CustomModules\Facades\CustomModules;
use App\Libraries\iLandingPageDetails;
use App\Libraries\LandingPageDetails;

class VanityHost
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function byHost( $user, iLandingPageDetails $landingPageDetails, $template = '') {

        // $routes = UserCustomPagesModule::getRoutes();

        // $landingPageUser->category;
        // dd($template);

        $data = [];
        $options = [];

        $data['selected_state'] = $user->profile->contact_state;

        $data['social_media'] = $this->genSocialMediaDetails( $user );
        // $data['ga_code'] = CustomModules::customModuleRender( 'google_analytics_module', $user['id'] );
        $data['ga_code'] = $landingPageDetails->getGACode();

        $data['selected_state'] = $user->profile->contact_state;
        $data['user']           = $user;
        $options['use_logo'] =  ! empty($user->profile->logo) || ! empty($user->profile->portrait) ;

        $company = $this->genCompanyDetails( $user->profile );

//        dd($company);

        $data['version'] = 'v3';

        $data['company'] = $company;
        $data['options'] = $options;
        $data['branding'] = $this->genBranding( $user, $options['use_logo'], $data['version'] );

       // dd($company);

        dd($data);

        // return view( 'landing-pages.v3.quote_modules.underwritten.index', $data );
        return view( $template, $data );
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
