<?php

namespace App\Http\Controllers\Api;

use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AffiliateUsersGroupController extends Controller
{
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

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AffiliateGroup $id
     * @return void
     */
    public function update(Request $request, AffiliateGroup $group)
    {

        // return response()->json(["success" => false, "data" => $group->id]);
        // return response()->json(["success" => false, "data" => $request->all()]);

        $data = $this->validate($request, [
            'user_id' => 'required',
            'affiliate_id' => 'required'
        ]);

        \DB::enableQueryLog();

        $aff_grp_user = AffiliateGroupUser::where('user_id', '=', $data['user_id'])->first();

        // okay we found it
        if ($aff_grp_user) {
            $aff_grp_user->group_id = $group->id;
            $aff_grp_user->save();
        } else {

            AffiliateGroupUser::create([
                'affiliate_id' => $data['affiliate_id'],
                'user_id' => $data['user_id'],
                'group_id' => $group->id
            ]);

        }


        $info = \DB::getQueryLog();

        return response()->json(["success" => true, "message" => "User assigned.", "info" => $info]);

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
