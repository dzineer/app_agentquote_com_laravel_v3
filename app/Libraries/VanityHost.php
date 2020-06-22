<?php

namespace App\Libraries;
use App\Models\Profile;
use App\Models\UserLanguage;
use Illuminate\Support\Facades\View;
use App\CustomModules\UserCustomPagesModule;
use Dzineer\CustomModules\Facades\CustomModules;
use App\Libraries\iLandingPageDetails;
use App\Libraries\LandingPageDetails;

class VanityHost
{
    /**
     * @param $user
     * @param \App\Libraries\iLandingPageDetails $landingPageDetails
     * @param string $template
     * @return mixed
     */
    public function byHost( $user, iLandingPageDetails $landingPageDetails, $template = '') {

        // $routes = UserCustomPagesModule::getRoutes();

        // $landingPageUser->category;
        // dd($template);

        $profile = Profile::where(['user_id' => $user->id])->first();

        $data = [];
        $options = [];

        $data['selected_state'] = $profile->contact_state;

        $data['social_media'] = $this->genSocialMediaDetails( $user, $profile );
        $data['book_appointment'] = $this->genBookAppointment( $user, $profile );

        if (isset($_GET['debugger'])) {
            dd($data);
        }

        // $data['ga_code'] = CustomModules::customModuleRender( 'google_analytics_module', $user['id'] );
        $data['ga_code'] = $landingPageDetails->getGACode();

        $data['selected_state'] = $profile->contact_state;
        $data['user']           = $user;

        $company = $this->genCompanyDetails( $user, $profile );

        $data['version'] = 'v3';

        $data['company'] = $company;
        $data['options'] = $options;
        $data['branding'] = $this->genBranding( $user, $profile, $company, $data['version'] );
        $data['languages_spoken'] = $this->getSpokenLanguages( $user );

        // dd($company);

        // dd($template);

        if ($_SERVER['REMOTE_ADDR'] === '171.4.221.131' && isset($_GET['dump'])) {
            dd($data);
        }

        // return view( 'landing-pages.v3.quote_modules.underwritten.index', $data );
        return view( $template, $data );
    }

    /**
     * @param $user
     * @return array
     */
    protected function getSpokenLanguages($user ) {
        $languages = UserLanguage::languagesSpoken( $user->id );
        $spoken = [];
        foreach($languages as $language) {

            if($language->subtag) {
                $spoken[] = $language->name . ' ' . '(' . strtoupper($language->subtag) . ')';
            } else {
                $spoken[] = $language->name;
            }
        }

        return json_encode($spoken);
    }

    /**
     * @param $user
     * @param $profile
     * @return array
     */
    protected function genCompanyDetails( $user, $profile ): array {

        return [
            'name' => empty($profile->company) ? $user->name : $profile->company,

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
     * @param $profile
     * @param $company
     * @param $version
     *
     * @return array
     */
    private function genBranding( $user, $profile, $company, $version ): array {

        $default_logo = asset_prepend('templates/landing-pages/' . $version . '/', 'images/logo-200x40.png');

        $useLogo = ! empty($profile->logo);
        $usePortrait = ! empty($profile->portrait);

        $imageUsed = $profile->portrait ? $profile->portrait : $profile->logo;

/*        dd([
            $useLogo,
            $imageUsed
        ]);*/

        $branding                  = [];
        $branding['company']       = $company;
        $branding['logo']['light'] = $useLogo ? $imageUsed : '';
        $branding['logo']['dark']  = '';
        $branding['special_text']  = 'We provide a full spectrum of mobile quoters and web applications for insurance agents. Focusing on Life insurance, Health, Financial Advisors, and P&C. Our quoters and website applications cover all stages of the program development life cycle and keep you one step ahead of the competition.';
        $branding['copyright']     = 'Agent Quote Inc.';
        $branding['use_logo']      =  $useLogo;
        $branding['use_portrait']  =  $usePortrait;

        // dd($branding);

        return $branding;
    }

    /**
     * @param $user
     * @param $profile
     * @return mixed
     */
    private function genSocialMediaDetails( $user, $profile ) {

        $socialMedia = [];

        if ( $profile->facebook_link && strlen( $profile->facebook_link ) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-facebook', 'link' => $profile->facebook_link ];
        }

        if ( $profile->twitter_link && strlen( $profile->twitter_link ) ) {
            $socialMedia[] = [ 'name' => 'twitter', 'icon' => 'fa-twitter', 'link' => $profile->twitter_link ];
        }

        if ( $profile->youtube_link && strlen( $profile->youtube_link ) ) {
            $socialMedia[] = [ 'name' => 'youtube', 'icon' => 'fa-youtube', 'link' => $profile->youtube_link ];
        }

        if ( $profile->linkedin_link && strlen( $profile->linkedin_link ) ) {
            $socialMedia[] = [ 'name' => 'linkedin', 'icon' => 'fa-linkedin', 'link' => $profile->linkedin_link ];
        }

        if ( $profile->instagram_link && strlen( $profile->instagram_link ) ) {
            $socialMedia[] = [ 'name' => 'instagram', 'icon' => 'fa-instagram', 'link' => $profile->instagram_link ];
        }

        return json_encode( $socialMedia );

    }

    /**
     * @param $user
     * @param $profile
     * @return mixed
     */
    private function genBookAppointment( $user, $profile ) {

        $bookAppointment = new \stdClass();
        $bookAppointment->hasLink = false;

        if ( $profile->calendly_link && strlen( $profile->calendly_link ) ) {
            $bookAppointment->link = $profile->calendly_link;
            $bookAppointment->hasLink = true;
        }

        return $bookAppointment;

    }

}
