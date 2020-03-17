<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    const PROGRAM_USER = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function getWHMCSUser(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        return response()->json([
            "message" => "User received.",
            "data" => $user,
            "success" => true,
        ]);


    }

    public function disableWHMCSUser(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }


        $user->update([
            'active' => 0
        ]);

        return response()->json([
            "message" => "User disabled.",
            "data" => request()->all(),
            "success" => true,
        ]);


    }

    public function enableWHMCSUser(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user->update([
            'active' => 1
        ]);

        return response()->json([
            "message" => "User disabled.",
            "data" => request()->all(),
            "success" => true,
        ]);
    }


    public function update(Request $request)
    {
        $actions = [
          '1',
          '0'
        ];

        $super_user = Auth::user();

        $action_reponse = [
            '1' => 'User enabled',
            '0' => 'User disabled'
        ];

        if (!$super_user->is_super()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $data = $this->validate($request, [
            'user_id' => 'required',
            'active' => 'required'
        ]);

        $user = User::find($data['user_id']);

        if ($user) {
            if (in_array($data['active'], $actions)) {
                $user->active = $data['active'];
                $user->save();

                $user_str = $action_reponse[ $data['active'] ];

                return response()->json([
                    'success' => true,
                    'message' => $user_str
                ]);

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid request'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid request'
        ]);

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
