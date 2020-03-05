<?php

namespace App\Http\Controllers\Api;

use App\AdminUser;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AffiliateAdminsController extends Controller
{
    const PASSWORD_STRENGTH = 16;
    const ADMIN_USER = 3;

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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'affiliate_id' => 'required'
        ]);

        if (AdminUser::where($data)->exists()) {
            return response()->json(["success" => false, "message" => "User already exists."]);
        }

        $affiliate = Affiliate::where('id', '=', $data['affiliate_id'])->first();

        if ($affiliate) {

            $aff_group = AffiliateGroupUser::where([
                'affiliate_id' => $data['affiliate_id'],
            ]);

            if ($aff_group) {

                $random_password = str_random(self::PASSWORD_STRENGTH);
                $hashed_random_password = Hash::make($random_password);
                $admin = AdminUser::create([
                    'fname' => $data['fname'],
                    'lname' => $data['fname'],
                    'email' => $data['email'],
                    'password' => $hashed_random_password,
                    'affiliate_id' => $affiliate->id
                ]);

                AffiliateGroupUser::create([
                    'affiliate_id' => $data['affiliate_id'],
                    'user_id' => $admin->id,
                ]);

                $admin = \DB::table('users')
                    ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.created_at','affiliate_groups.id as group_id')
                    ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                    ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                    ->where('users.type_id', '=', self::ADMIN_USER)
                    ->where('users.affiliate_id', '=', $affiliate->id)
                    ->get();

                $admin->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($admin->created_at))->diffForHumans();

                // TODO: Setup email message for new admin signup to confirm his account to active it.

                return response()->json(["success" => true, "message" => "Administrator created successfully.", "admin" => $admin]);

            } else {
                return response()->json(["success" => false, "message" => "Affiliate group does not exist."]);
            }

        } else {
            return response()->json(["success" => false, "message" => "Affiliate does not exist."]);
        }

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
