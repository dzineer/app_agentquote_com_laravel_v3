<?php

namespace App\Http\Controllers\Api;

use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AffiliateGroupsController extends Controller
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
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'affiliate_id' => 'required',
        ]);

        if (AffiliateGroup::where([
            'affiliate_id' => $data['affiliate_id'],
            'name' => $data['name'],
        ])->exists()) {
            return response()->json(["success" => false, "message" => "Group already exists."]);
        }

        $group = AffiliateGroup::updateOrCreate([
            'affiliate_id' => $data['affiliate_id'],
            'name' => $data['name'],
        ],
            $data
        );

        // if we get a user id we want to also assign that user to the affiliate group
        // we we found an existing user_id for the affiliate group then update it.
        if ($request->has('user_id')) {
            AffiliateGroupUser::updateOrCreate([
                    'user_id' => $request->input('user_id')
                ],
                [
                    'affiliate_id' => $data['affiliate_id'],
                    'user_id' => $request->input('user_id'),
                    'group_id' => $group->id
            ]);
        } else {

        }

        // $query_log = \DB::getQueryLog();

        return response()->json(["success" => true, "message" => "Group added.", "group" => $group]);
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
     * @param \App\Models\AffiliateGroup $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AffiliateGroup $group)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'affiliate_id' => 'required',
        ]);

        $group->update($data);

        // $query_log = \DB::getQueryLog();

        return response()->json(["success" => true, "message" => "Group updated.", "data" => $group]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AffiliateGroup $group
     * @return void
     * @throws \Exception
     */
    public function destroy(AffiliateGroup $group)
    {
        // make sure we don't delete a group where a user is currently associated with it
        $total = AffiliateGroupUser::where('group_id', '=', $group->id)->get()->count();

        if ($total !== 0) {
            return response()->json(["success" => false, "message" => "Users are associated with this group, or this a default group. You must first remove all users from this group. Note: you cannot delete a default group."]);
        }

        $deleted_group = $group->delete();

        return response()->json(["success" => true, "message" => "Group deleted.", "group" => $deleted_group]);

    }
}
