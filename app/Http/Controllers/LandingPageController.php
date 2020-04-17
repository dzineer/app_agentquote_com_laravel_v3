<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\LandingPageCategory;
use App\Models\LandingPageUser;
use App\Models\UserGoogleAnalytic;
use App\User;
use Dzineer\LandingPages\Models\UserDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\AQLog;

/**
 * Class LandingPageController
 * @package App\Http\Controllers
 */
class LandingPageController extends BackendController
{
    const LOGO_MAX_HEIGHT = 100;
    const LOGO_MAX_WIDTH = 300;
    const PORTRAIT_MAX_WIDTH = 100;
    const PORTRAIT_MAX_HEIGHT = 100;

    /**
     * @return array|string
     * @throws \Throwable
     */
    public function settings()
	{
        $user = Auth::user();
        $gaCode = '';

        $categories = LandingPageCategory::all();
        $currentPageCategory = LandingPageUser::where(['user_id' => $user->id])->first();
        $gaCodeRecord = UserGoogleAnalytic::where(['user_id' => $user->id])->first();

        if ($gaCodeRecord) {
            $gaCode = $gaCodeRecord->data;
        }

        $data = [
            "user" => $user,
            "ga_code" => $gaCode,
            "pageCategories" => json_encode($categories),
            "currentPageCategory" => json_encode($currentPageCategory)
        ];

        if ($_SERVER['REMOTE_ADDR'] === '171.4.220.71') {
        //    dd($data);
        }


		return view('landing-pages.profile.index', $data)->render();
	}

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $id)
    {
        $data = $this->validate($request, [
            'logo' => 'max:300',
            'portrait' => 'max:300'
        ]);

        $user = Auth::user();


        $profile = Profile::create([
            'user_id' => $user->id
        ]);

        $profileUpdated = false;

        // save logo to store/public/landing-pages/logos and filename to profile
        if ($request->hasFile('logo')) {

            $ext = $request->file('logo')->guessExtension();

            if ($ext == "txt") {
                $md5Name = md5_file($request->file('logo')->getRealPath());
                $ext = 'svg';

                $profile->logo = env('AGENT_LOGO_PATH') . '/' . $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
            } else {
                $profile->logo = env('AGENT_LOGO_PATH') . '/' . $request->file('logo')->store('landing-pages/logos', 'public');
            }


            $profile->save();
        }

        // save portrait to store/public/landing-pages/portraits and filename to profile
        if ($request->hasFile('portrait')) {
            $ext = $request->file('portrait')->guessExtension();
            if ($ext == "txt") {
                $md5Name = md5_file($request->file('portrait')->getRealPath());
                $ext = 'svg';
                $profile->portrait = env('AGENT_LOGO_PATH') . '/' . $request->file('portrait')->storeAs('landing-pages/portraits', $md5Name.'.'.$ext  ,'public');
            } else {
                $profile->portrait = env('AGENT_LOGO_PATH') . '/' . $request->file('portrait')->store('landing-pages/portraits', 'public');
            }
            $profileUpdated = true;
        }

        if ($request->has('product_category')) {
            $category_id = $request->input('product_category');
            $landingPageUserRecord = LandingPageUser::where(['user_id' => $user->id]);
            if ($landingPageUserRecord->exists()) {
                $landingPageUserRecord->update(['category_id' => $category_id]);
            }
        }

        if ($request->has('ga_code')) {
            $gaCode = $request->input('ga_code');
            $userGoogleAnalyticsRecord = UserGoogleAnalytic::where(['user_id' => $user->id]);
            if ($userGoogleAnalyticsRecord->exists()) {
                $userGoogleAnalyticsRecord->update(['data' => $gaCode]);
            } else {
                UserGoogleAnalytic::create(['user_id' => $user->id, 'data' => $gaCode ]);
            }
        }

        if ($request->has('company')) {
            $profile->company = $request->input('company');
            $profileUpdated = true;
        }

        if ($request->has('position_title')) {
            $profile->position_title = $request->input('position_title');
            $profileUpdated = true;
        }

        if ($request->has('contact_email')) {
            $profile->contact_email = $request->input('contact_email');
            $profileUpdated = true;
        }

        if ($request->has('contact_phone')) {
            $profile->contact_phone = $request->input('contact_phone');
            $profileUpdated = true;
        }

        if ($request->has('contact_addr1')) {
            $profile->contact_addr1 = $request->input('contact_addr1');
            $profileUpdated = true;
        }

        if ($request->has('contact_addr2')) {
            $profile->contact_addr2 = $request->input('contact_addr2');
            $profileUpdated = true;
        }

        if ($request->has('contact_city')) {
            $profile->contact_city = $request->input('contact_city');
            $profileUpdated = true;
        }

        if ($request->has('contact_state')) {
            $profile->contact_state = $request->input('contact_state');
            $profileUpdated = true;
        }

        if ($request->has('contact_zip')) {
            $profile->contact_zip = $request->input('contact_zipcode');
            $profileUpdated = true;
        }

        if ($profileUpdated) {
            $profile->save();
        }

        return response()->json(["success" => true, "message" => 'Profile updated.', "profile" => $profile]);
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        // return response()->json($user);

        $profile = Profile::where(['user_id' => $user->id])->first();

        $resp = new \stdClass();

        $resp->contact_email = $profile->contact_email;
        $resp->company = $profile->company;
        $resp->position_title = $profile->position_title;
        $resp->contact_phone = $profile->contact_phone;
        $resp->contact_addr1 = $profile->contact_addr1;
        $resp->contact_addr2 = $profile->contact_addr2;
        $resp->contact_city = $profile->contact_city;
        $resp->contact_state = $profile->contact_state;
        $resp->contact_zipcode = $profile->contact_zip;

        $resp->facebook_link = $profile->facebook_link ?: '';
        $resp->twitter_link = $profile->twitter_link ?: '';
        $resp->youtube_link = $profile->youtube_link ?: '';
        $resp->linkedin_link = $profile->linkedin_link ?: '';
        $resp->instagram_link = $profile->instagram_link ?: '';
        $resp->calendly_link = $profile->calendly_link ?: '';

        if( $profile->logo ) {
            $resp->logo = $profile->logo;
        } else {
            $resp->logo = null;
        }

        if( $profile->portrait ) {
            $resp->portrait = $profile->portrait;
        } else {
            $resp->portrait = null;
        }

        $subdomain = UserDomain::where(['user_id' => $user->id])->first();

        $resp->vanity_domain = $subdomain->domain;

        return response()->json($resp);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'logo' => 'max:300',
            'portrait' => 'max:300'
        ]);

        $ext = '';

        $profile = Profile::where([
            "user_id" => $user->id
        ])->first();

        // save logo to store/public/landing-pages/logos and filename to profile

        AQLog::info([
            "hasFile" => $request->hasFile('logo'),
            "logo" => $request->input('logo')
        ]);

        if (! $request->hasFile('logo') && $request->has('logo') && $request->input('logo') === 'null') {
            $fieldsToUpdate["logo"] = null;
            $profileUpdated = true;
            AQLog::info([
                "description" => "Logo to be erased",
                "hasFile" => $request->hasFile('logo'),
                "logo" => $request->has('logo'),
                "profile" => $profile]
            );

        }
        else if ($request->hasFile('logo')) {

            $ext = $request->file('logo')->guessExtension();

            list ($imageWidth, $imageHeight) = getimagesize($_FILES['logo']['tmp_name']);

            if ($imageWidth > self::LOGO_MAX_WIDTH || $imageHeight > self::LOGO_MAX_HEIGHT) {
                return response()->json(["success" => false, "message" => 'Incorrect logo dimensions.']);
            }

            switch( $ext) {
                case 'png':
                    $md5Name = md5_file($request->file('logo')->getRealPath());
                    $fieldsToUpdate["logo"] = env('AGENT_LOGO_PATH') . '/' . $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
                    $fieldsToUpdate["portrait"] = null;
                    $profileUpdated = true;
                    break;
                case 'jpg':
                    $md5Name = md5_file($request->file('logo')->getRealPath());
                    $fieldsToUpdate["logo"] = env('AGENT_LOGO_PATH') . '/' . $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
                    $fieldsToUpdate["portrait"] = null;
                    $profileUpdated = true;
                    break;
                case 'gif':
                    $md5Name = md5_file($request->file('logo')->getRealPath());
                    $fieldsToUpdate["logo"] = env('AGENT_LOGO_PATH') . '/' . $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
                    $fieldsToUpdate["portrait"] = null;
                    $profileUpdated = true;
                    break;

                default:
            }

        }

        if (! $request->hasFile('portrait') && $request->has('portrait') && $request->input('portrait')  === 'null') {
            $fieldsToUpdate["portrait"] = null;
            $profileUpdated = true;
        }
        // save portrait to store/public/landing-pages/portraits and filename to profile
        else if ($request->hasFile('portrait')) {

            list ($imageWidth, $imageHeight) = getimagesize($_FILES['portrait']['tmp_name']);

            if ($imageWidth > self::PORTRAIT_MAX_WIDTH || $imageHeight > self::PORTRAIT_MAX_HEIGHT) {
                return response()->json(["success" => false, "message" => 'Incorrect portrait dimensions.']);
            }

            $ext = $request->file('portrait')->guessExtension();
            if ($ext == "txt") {
                $md5Name = md5_file($request->file('portrait')->getRealPath());
                $ext = 'svg';
                $fieldsToUpdate["portrait"] = env('AGENT_LOGO_PATH') . '/' . $request->file('portrait')->storeAs('landing-pages/portraits', $md5Name.'.'.$ext  ,'public');
                $fieldsToUpdate["logo"] = null;
                $profileUpdated = true;
            } else {
                $fieldsToUpdate["portrait"] = env('AGENT_LOGO_PATH') . '/' . $request->file('portrait')->store('landing-pages/portraits', 'public');
                $fieldsToUpdate["logo"] = null;
                $profileUpdated = true;
            }
        }

        if ($request->has('product_category')) {
            $category_id = $request->input('product_category');
            $landingPageUserRecord = LandingPageUser::where(['user_id' => $user->id]);
            if ($landingPageUserRecord->exists()) {
                $landingPageUserRecord->update(['category_id' => $category_id]);
            }
        }

        if ($request->has('ga_code')) {
            $gaCode = $request->input('ga_code');
            $userGoogleAnalyticsRecord = UserGoogleAnalytic::where(['user_id' => $user->id]);
            if ($userGoogleAnalyticsRecord->exists()) {
                $userGoogleAnalyticsRecord->update(['data' => $gaCode]);
            } else {
                UserGoogleAnalytic::create(['user_id' => $user->id, 'data' => $gaCode ]);
            }
        }

        $profile = new Profile();

        foreach($profile->getFields() as $field) {
            if ($request->has($field)) {
                $fieldsToUpdate[ $field ] = $request->input($field);
                if (strlen($fieldsToUpdate[$field]) === 0) {
                    $fieldsToUpdate[ $field ] = NULL;
                }
            }
        }

        if (count($fieldsToUpdate)) {
            Profile::where(["user_id" => $user->id])->update($fieldsToUpdate);
        }

        return response()->json(["success" => true, "message" => 'Profile updated.', "profile" => $profile, "extra" => $ext]);
    }

}
