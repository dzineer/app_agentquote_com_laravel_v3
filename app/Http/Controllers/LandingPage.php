<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPage extends Controller
{
    public function index(Request $request) {

         return response()->json([
             'data' => $request->all()
         ]);

        $domain = $request->instance()->query('domain');

        if ($domain) {
            $user = User::find($domain['user_id']);
        }

        if (! $user) {
            return abort(405);
        }

        $profile = Profile::where('user_id', $user['id'])->first();

        $use_form_only = true;

        $data = config('landing_page.data');

        $socialMedia = [];

        if ( $user->profile->facebook_link && strlen($user->profile->facebook_link) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-facebook', 'link' => $user->profile->facebook_link ];
        }

        if ( $user->profile->twitter_link && strlen($user->profile->twitter_link) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-twitter', 'link' => $user->profile->twitter_link ];
        }

        if ( $user->profile->youtube_link && strlen($user->profile->youtube_link) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-youtube', 'link' => $user->profile->youtube_link ];
        }

        if ( $user->profile->linkedin_link && strlen($user->profile->linkedin_link) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-linkedin', 'link' => $user->profile->linkedin_link ];
        }

        if ( $user->profile->instagram_link && strlen($user->profile->instagram_link) ) {
            $socialMedia[] = [ 'name' => 'facebook', 'icon' => 'fa-instagram', 'link' => $user->profile->instagram_link ];
        }

        $data['user_id'] =  $user['id'];

        $data['social_media'] = json_encode($socialMedia);
       // $data['social_media'] = $socialMedia;
        $data['use_logo'] = $data["options"]["use_logo"] ? 1 : 0;
        $data['brand_logo'] = $data["options"]["use_logo"] ? $data['branding']['logo']['light'] : '';
        $data['brand_company'] = ! $data["options"]["use_logo"] ? $data['branding']['company'] : '';

        // dd(json_decode(json_encode($data['menus'])));

        // dd($data);

        if ($request->has('state')) {
            $data['selected_state'] = $request->has('state');
            return view('landing-pages.v1.pages.home.index', $data);

        } else {
            return view('landing-pages.v1.pages.home.index-form-only', $data);
        }
    }
}
