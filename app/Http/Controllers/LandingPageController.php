<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\LandingPageCategory;
use App\Models\LandingPageUser;
use App\Models\UserGoogleAnalytic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\AQLog;

/**
 * Class LandingPageController
 * @package App\Http\Controllers
 */
class LandingPageController extends BackendController
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function settings()
	{
        $user = Auth::user();
        $gaCode = '';

        // dd($user->profile);

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

        // dd($data);

/*        AQLog::info(print_r([
            'message' => "data",
            'data' => $data
        ], true), __CLASS__ . '::' . __METHOD__);*/

		// $response = view('landing-pages.profile.index', $data)->render();
		return view('landing-pages.profile.index', $data)->render();
/*
        AQLog::info(print_r([
            'message' => "landing-pages.profile.index",
            'response' => $response
        ], true), __CLASS__ . '::' . __METHOD__);*/

		// return $response;
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $this->validate($request, [
            'logo' => 'max:300',
            'portrait' => 'max:300'
        ]);

        $user = Auth::user();
        // echo print_r($user,true);
        // exit;
        // $subdomain = auth()->user()

        // echo print_r($user, true);
        // exit;

        $profile = Profile::create([
            'user_id' => $user->id
        ]);

        $profileUpdated = false;

        // assign profile id to user

        $user->profile_id = $profile->id;
        $user->save();

        // save logo to store/public/landing-pages/logos and filename to profile
        if ($request->hasFile('logo')) {

            $ext = $request->file('logo')->guessExtension();

            if ($ext == "txt") {
                $md5Name = md5_file($request->file('logo')->getRealPath());
                $ext = 'svg';
                $profile->logo = '/storage/' . $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
            } else {
                $profile->logo = '/storage/' . $request->file('logo')->store('landing-pages/logos', 'public');
            }


            $profile->save();
        }

        // save portrait to store/public/landing-pages/portraits and filename to profile
        if ($request->hasFile('portrait')) {
            $ext = $request->file('portrait')->guessExtension();
            if ($ext == "txt") {
                $md5Name = md5_file($request->file('portrait')->getRealPath());
                $ext = 'svg';
                $profile->portrait = '/storage/' . $request->file('portrait')->storeAs('landing-pages/portraits', $md5Name.'.'.$ext  ,'public');
            } else {
                $profile->portrait = '/storage/' . $request->file('portrait')->store('landing-pages/portraits', 'public');
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
        $profile = $user->profile;

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


        return response()->json($resp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'logo' => 'max:300',
            'portrait' => 'max:300'
        ]);

        // $profile = $user->profile;
        $profileUpdated = false;
        $fieldsToUpdate = [];

        // cho print_r($profile, true);
        // exit;

        // assign profile id to user

        $ext = '';

       // return response()->json(["success" => false, "Input" => $request->all()]);


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

            switch( $ext) {
                case 'png':
                    $md5Name = md5_file($request->file('logo')->getRealPath());
                    $fieldsToUpdate["logo"] = '/storage/' . $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
                    $fieldsToUpdate["profile"] = null;
                    $profileUpdated = true;
                    break;
                case 'jpg':
                    $md5Name = md5_file($request->file('logo')->getRealPath());
                    $fieldsToUpdate["logo"] = '/storage/' . $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
                    $fieldsToUpdate["profile"] = null;
                    $profileUpdated = true;
                    break;
                case 'gif':
                    $md5Name = md5_file($request->file('logo')->getRealPath());
                    $fieldsToUpdate["logo"] = '/storage/' . $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
                    $fieldsToUpdate["profile"] = null;
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
            $ext = $request->file('portrait')->guessExtension();
            if ($ext == "txt") {
                $md5Name = md5_file($request->file('portrait')->getRealPath());
                $ext = 'svg';
                $fieldsToUpdate["portrait"] = '/storage/' . $request->file('portrait')->storeAs('landing-pages/portraits', $md5Name.'.'.$ext  ,'public');
                $fieldsToUpdate["logo"] = null;
                $profileUpdated = true;
            } else {
                $fieldsToUpdate["portrait"] = '/storage/' . $request->file('portrait')->store('landing-pages/portraits', 'public');
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

        $fields = [
          [ 'name' => 'company', 'key' => 'company'],
          [ 'name' => 'position_title', 'key' => 'position_title'],
          [ 'name' => 'contact_email', 'key' => 'contact_email'],
          [ 'name' => 'contact_phone', 'key' => 'contact_phone'],
          [ 'name' => 'contact_addr1', 'key' => 'contact_addr1'],
          [ 'name' => 'contact_addr2', 'key' => 'contact_addr2'],
          [ 'name' => 'contact_city', 'key' => 'contact_city'],
          [ 'name' => 'contact_state', 'key' => 'contact_state'],
          [ 'name' => 'contact_zipcode', 'key' => 'contact_zip'],
          [ 'name' => 'facebook_link', 'key' => 'facebook_link'],
          [ 'name' => 'twitter_link', 'key' => 'twitter_link'],
          [ 'name' => 'youtube_link', 'key' => 'youtube_link'],
          [ 'name' => 'linkedin_link', 'key' => 'linkedin_link'],
          [ 'name' => 'instagram_link', 'key' => 'instagram_link'],
        ];


        foreach( $fields as $field ) {
            if ($request->has( $field['name'] )) {
                $n = $field['key'];
                $profile->$n = $request->input( $field['name'] );
                $fieldsToUpdate[ $n ] = $request->input( $field['name'] );
                $profileUpdated = true;
            }
        }

        if (count($fieldsToUpdate)) {
            Profile::where(["user_id" => $user->id])->update($fieldsToUpdate);
        }

        // AQLog::info(["success" => false, "request" => $request->all(), "profile" => $profile]);

       // return response()->json(["success" => false, "request" => $request->all(), "profile" => $profile]);

       // dd($request->all());

        return response()->json(["success" => true, "message" => 'Profile updated.', "profile" => $profile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
