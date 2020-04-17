<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        // assign profile id to user

        $user->profile_id = $profile->id;
        $user->save();

        // save logo to store/public/landing-pages/logos and filename to profile
        if ($request->hasFile('logo')) {

            $ext = $request->file('logo')->guessExtension();

            if ($ext == "txt") {
                $md5Name = md5_file($request->file('logo')->getRealPath());
                $ext = 'svg';
                $profile->logo = $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
            } else {
                $profile->logo = $request->file('logo')->store('landing-pages/logos', 'public');
            }

            $profile->save();
        }

        // save portrait to store/public/landing-pages/portraits and filename to profile
        if ($request->hasFile('portrait')) {
            $ext = $request->file('portrait')->guessExtension();
            if ($ext == "txt") {
                $md5Name = md5_file($request->file('portrait')->getRealPath());
                $ext = 'svg';
                $profile->portrait = $request->file('portrait')->storeAs('landing-pages/portraits', $md5Name.'.'.$ext  ,'public');
            } else {
                $profile->portrait = $request->file('portrait')->store('landing-pages/portraits', 'public');
            }
            $profile->save();
        }

        if ($request->has('company')) {
            $profile->company = $request->input('company');
        }

        if ($request->has('position_title')) {
            $profile->position_title = $request->input('position_title');
        }

        if ($request->has('contact_email')) {
            $profile->contact_email = $request->input('contact_email');
        }

        if ($request->has('contact_phone')) {
            $profile->contact_phone = $request->input('contact_phone');
        }

        if ($request->has('contact_addr1')) {
            $profile->contact_addr1 = $request->input('contact_addr1');
        }

        if ($request->has('contact_addr2')) {
            $profile->contact_addr2 = $request->input('contact_addr2');
        }

        if ($request->has('contact_city')) {
            $profile->contact_city = $request->input('contact_city');
        }

        if ($request->has('contact_state')) {
            $profile->contact_state = $request->input('contact_state');
        }

        if ($request->has('contact_zip')) {
            $profile->contact_zip = $request->input('contact_zipcode');
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
        $profile = Profile::where("user_id", "=", $user->id)->first();
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

        if( $profile->logo ) {
            $resp->logo = asset("storage/$profile->logo");
        }
        if( $profile->portrait ) {
            $resp->portrait = asset("storage/$profile->portrait");
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'logo' => 'max:300',
            'portrait' => 'max:300'
        ]);

        $user = Auth::user();

        $profile = Profile::where("user_id", "=", $user->id);

        //   echo print_r($profile, true);
        //   exit;

        // assign profile id to user

        // save logo to store/public/landing-pages/logos and filename to profile
        if ($request->hasFile('logo')) {

            $ext = $request->file('logo')->guessExtension();

            if ($ext == "txt") {
                $md5Name = md5_file($request->file('logo')->getRealPath());
                $ext = 'svg';
                $profile->logo = $request->file('logo')->storeAs('landing-pages/logos', $md5Name.'.'.$ext  ,'public');
            } else {
                $profile->logo = $request->file('logo')->store('landing-pages/logos', 'public');
            }
        }

        // save portrait to store/public/landing-pages/portraits and filename to profile
        if ($request->hasFile('portrait')) {
            $ext = $request->file('portrait')->guessExtension();
            if ($ext == "txt") {
                $md5Name = md5_file($request->file('portrait')->getRealPath());
                $ext = 'svg';
                $profile->portrait = $request->file('portrait')->storeAs('landing-pages/portraits', $md5Name.'.'.$ext  ,'public');
            } else {
                $profile->portrait = $request->file('portrait')->store('landing-pages/portraits', 'public');
            }
        }

        if ($request->has('company')) {
            $profile->company = $request->input('company');
        }

        if ($request->has('position_title')) {
            $profile->position_title = $request->input('position_title');
        }

        if ($request->has('contact_email')) {
            $profile->contact_email = $request->input('contact_email');
        }

        if ($request->has('contact_phone')) {
            $profile->contact_phone = $request->input('contact_phone');
        }

        if ($request->has('contact_addr1')) {
            $profile->contact_addr1 = $request->input('contact_addr1');
        }

        if ($request->has('contact_addr2')) {
            $profile->contact_addr2 = $request->input('contact_addr2');
        }

        if ($request->has('contact_city')) {
            $profile->contact_city = $request->input('contact_city');
        }

        if ($request->has('contact_state')) {
            $profile->contact_state = $request->input('contact_state');
        }

        if ($request->has('contact_zipcode')) {
            $profile->contact_zip = $request->input('contact_zipcode');
        }

        if($profile->isDirty()) {
            $profile->save();
        }

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
