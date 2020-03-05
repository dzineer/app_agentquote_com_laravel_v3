<?php

namespace App\Http\Controllers;

use App\Events\PasswordResetRequest;
use App\Events\PasswordUpdated;
use App\Libraries\AQInvites;
use App\Models\Confirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MyAccountController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('my-account');
    }

	public function settings()
	{
		return view('my-account');
	}

	public function security() {
		return view('password');
	}

	public function fchangepass() {
        $data = $this->validate(request(), [
           'confirmation_token' => 'required'
        ]);

        $user = Auth::user();

        $confirmation_token = $data['confirmation_token'];
        // dd($confirmation_token);
		return view('force-password', ['user' => $user, 'confirmation_token' => $confirmation_token]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth::user();
	    $resp = new \stdClass();
	    $resp->name = $user->name;
	    $resp->email = $user->email;

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
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
	    $data = $this->validate($request, [
		    'name' => 'min:2',
		    'email' => 'min:5,max:40'
	    ]);

	    // Must not already exist in the `email` column of `users` table
	    $rules = [
		    'email' => 'unique:users,email'
	    ];

	    $validator = Validator::make($data, $rules);

        $user = Auth::user();

	    $resp = new \stdClass();

	    if ($validator->fails()) {
	    	$resp->failed = true;
	    	if ($user->email !== $request->input('email')) {
		    	$resp->message = "Email already exists, please try a different one";
			    return response()->json($resp);
		    }
	    }

	    $user->name = $request->input('name');
	    $user->email = $request->input('email');
	    $user->save();

	    return response()->json(["success" => true, "message" => 'Account updated.', "user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
	    $rules = [
		    'current_password' => 'min:8,max:40',
		    'new_password' => 'min:8,max:40'
	    ];

        $user = Auth::user();

	    $resp = new \stdClass();

	    $credentials = ["email" => $user->email, "password" => $request->input('current_password')];

	    // $user->bcrypt($request->get('new_password'))
		// Hash::check($curPassword, $user->password

	    if (!Auth::attempt($credentials)) {
	    	$resp->failed = true;
	        $resp->message = "Your current password does not match the password you provided.";
		    return response()->json($resp);
	    }

	    $user->password = Hash::make($request->input('new_password'));
	    $user->save();

	    return response()->json(["success" => true, "message" => 'You password has been updated.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePasswordForcePass(Request $request, $id)
    {
        $rules = [
            'new_password' => 'min:8,max:40',
            'confirmation_token' => 'required'
        ];

        $data = $this->validate($request, $rules);

        $user = Auth::user();

        $token = Confirmation::where([
            'user_id' => $user->id,
            'confirmation_token' => $data['confirmation_token']
        ])->first();

        if ($token) {

            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            AQInvites::removeConfirmation($token->confirmation_token);

            // notify laravel a password updated.
            event(new PasswordUpdated($user));

            return response()->json(["success" => true, "message" => 'You password has been updated.']);
        } else {
            return response()->json(["success" => false, "message" => 'Token invalid.']);
        }
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
