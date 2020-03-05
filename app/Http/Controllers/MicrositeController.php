<?php

namespace App\Http\Controllers;

use App\Models\Microsite;
use App\Models\ColorsUser;
use App\Models\Profile;
use App\Models\UserSubdomain;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Libraries\FD3Color;

class MicrositeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('microsite');
    }

	public function settings()
	{
		return view('microsite');
	}

	public function subdomain_home($name)
	{
		// dd($subdomain);
		$subdomain = UserSubdomain::where("name", "=", $name)->first();
		if ($subdomain) { // let's get the user now and their profile
			$user = User::find($subdomain->user_id);
			if ($user) {

				$microsite = Microsite::where("user_id", $user->id)->first();

				if ($microsite) {
					$profile = Profile::find($user->profile_id);
					if ($profile) {
						// return response()->json($user);
						$resp = [];
						$resp['show_logo'] = false;
						if( $profile->logo ) {
							$profile->logo = asset("storage/$profile->logo");
							$resp['logo'] = $profile->logo;
							$resp['show_logo'] = $microsite->show_logo === 1;
						}
						$resp['show_portrait'] = false;
						if( $profile->portrait ) {
							$profile->portrait = asset("storage/$profile->portrait");
							$resp['portrait'] = $profile->portrait;
							$resp['show_portrait'] = $microsite->show_portrait === 1;
						}

						$resp['name'] = $user->name;

						$resp['company'] = $profile->company;
						$resp['position_title'] = $profile->position_title;

						$resp['contact_email'] = $profile->contact_email;
						$resp['contact_phone'] = $profile->contact_phone;
						$resp['contact_addr1'] = $profile->contact_addr1;
						$resp['contact_addr2'] = $profile->contact_addr2;
						$resp['contact_city'] = $profile->contact_city;
						$resp['contact_state'] = $profile->contact_state;
						$resp['contact_zipcode'] = $profile->contact_zip;

						$user_colors = ColorsUser::find($user->id);
						$colors = new \stdClass();

						// get user colors
						// if the user does not have colors provide them with the default colors
						// convert the colors to rgba css format

						if ($user_colors) {
							$color =  (object) json_decode($user_colors->header_background, true);
							$colors->header_background = FD3Color::rbga($color);
							$color =  (object) json_decode($user_colors->menu_bar, true);
							$colors->menu_bar = FD3Color::rbga($color);
							$color =  (object) json_decode($user_colors->rates_background, true);
							$colors->rates_background = FD3Color::rbga($color);
							$color =  (object) json_decode($user_colors->banner_form_background, true);
							$colors->banner_form_background = FD3Color::rbga($color);
							$resp['colors'] = $colors;
						} else {
							// default colors
							$color =  (object) json_decode('{"r": "232","g": "232","b": "232", "a":"1"}', true);
							$colors->header_background = FD3Color::rbga($color);
							$color =  (object) json_decode('{"r": "128","g": "128","b": "128", "a":"1"}', true);
							$colors->menu_bar = FD3Color::rbga($color);
							$color =  (object) json_decode('{"r": "238","g": "238","b": "238", "a":"1"}', true);
							$colors->rates_background = FD3Color::rbga($color);
							$color =  (object) json_decode('{"r": "4","g": "173","b": "249", "a":"1"}', true);
							$colors->banner_form_background = FD3Color::rbga($color);
							$resp['colors'] = $colors;
						}

						// echo "<pre>" . print_r($colors,true); exit;

						//return response()->json($resp);
						return view('microsite-home', [ "content" => json_encode($resp, JSON_FORCE_OBJECT), "profile" =>  $resp ]);

					}
				}

			}
		}
		abort(404);
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
    public function store(Request $request)
    {
	    $data = $this->validate($request, [
	    	'subdomain' => 'required',
		    'category_id' => 'required|numeric',
		    'show_logo',
		    'show_portrait'
	    ]);

	    // echo print_r($request->all(), true); exit;

	    $user = Auth::user();

	    $microsite = Microsite::create([
	    	"user_id" => $user->id,
		    "default_category_id" => $request->input('category_id'),
		    "provide_id" => $user->id
	    ]);

	    if ($request->input('show_logo')) {
		    $microsite->show_logo = intval($request->input('show_logo'));
		    $microsite->save();
	    }

	    if ($request->input('show_portrait')) {
		    $microsite->show_logo = intval($request->input('show_portrait'));
		    $microsite->save();
	    }

	    return response()->json(["success" => true, "message" => 'Microsite created.', "microsite" => $microsite]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $user = Auth::user();
	    // return response()->json($user);
	    $microsite = Microsite::find($user->id);
	    // return response()->json($microsite);
	    $subdomain = UserSubdomain::find($microsite->subdomain_id);
	    // return response()->json($subdomain);
	    $user_colors = ColorsUser::where("user_id", $user->id)->first();

	    $resp = new \stdClass();
	    $resp->id = $microsite->id;
	    $resp->subdomain = $subdomain->name;
	    $resp->default_category_id = $microsite->default_category_id;
	    $resp->show_logo = $microsite->show_logo;
	    $resp->show_portrait = $microsite->show_portrait;

        $resp->colors = new \stdClass();

	    // get user colors
	    // if the user does not have colors provide them with the default colors
	    // convert the colors to rgba css format

	    if ($user_colors) {
	    	$resp->colors->header_background = $user_colors->header_background;
	    	$resp->colors->menu_bar = $user_colors->menu_bar;
	    	$resp->colors->rates_background = $user_colors->rates_background;
	    	$resp->colors->banner_form_background = $user_colors->banner_form_background;
	    }
		else {
	        // default colors
			$resp->colors->header_background = '{"r": "232","g": "232","b": "232", "a":"1"}';
			$resp->colors->menu_bar = '{"r": "128","g": "128","b": "128", "a":"1"}';
			$resp->colors->banner_form_background = '{"r": "238","g": "238","b": "238", "a":"1"}';
			$resp->colors->rates_background = '{"r": "4","g": "173","b": "249", "a":"1"}';
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
		    'subdomain' => 'min:4|max:20',
		    'default_category_id' => 'numeric',
		    'show_logo',
		    'show_portrait',
		    'menu_bar',
		    'header_background',
		    'banner_form_background',
		    'rates_background',
	    ]);

	    // echo print_r($request->all(), true); exit;

	    $user = Auth::user();

	    // Must not already exist in the `email` column of `users` table
	    $rules = [
		    'subdomain' => 'unique:subdomains,name'
	    ];

	    $validator = Validator::make($data, $rules);

	    $resp = new \stdClass();

	    $microsite = Microsite::where("user_id", $user->id)->first();

	    if ($validator->fails()) {
		    $resp->failed = true;
		    $subdomain = UserSubdomain::where("user_id", $user->id)->first();
		    if ($subdomain->name !== $request->input('subdomain')) {
			    $resp->message = "Sub Domain already exists, please try a different one";
			    return response()->json($resp);
		    }
	    } else {
	    	$subdomain = UserSubdomain::where("user_id", $user->id)->first();
	    	$subdomain->name = $request->input('subdomain');
	    	$subdomain->save();
	    }

	    $microsite->show_logo = intval($request->input('show_logo'));
	    $microsite->show_portrait = intval($request->input('show_portrait'));

	    $user_colors = ColorsUser::where("user_id", $user->id)->first();

	    // echo print_r($request->all(), true); exit;

	    if ($user_colors)
	    {

		    if ($request->has('header_background'))
		    {
			    $user_colors->header_background = $request->input('header_background');
		    }

		    if ($request->has('menu_bar'))
		    {
			    $user_colors->menu_bar = $request->input('menu_bar');
		    }
		    if ($request->has('banner_form_background'))
		    {
			    $user_colors->banner_form_background = $request->input('banner_form_background');
		    }

		    if ($request->has('rates_background'))
		    {
			    $user_colors->rates_background = $request->input('rates_background');
		    }

		    $user_colors->save();
	    }

	    $microsite->save();

	    return response()->json(["success" => true, "message" => 'Microsite updated.', "microsite" => $microsite]);
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
