<?php

namespace App\Http\Controllers\Api;

use App\Libraries\UserAffiliateAssociate;
use App\Models\Affiliate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SuperUserAffiliatesController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $data = $this->validate($request, [
            "user_id" => "required",
            "affiliate_id" => "required",
        ]);

        $user_id = $data['user_id'];
        $affiliate_id = $data['affiliate_id'];

        $super_user = Auth::user();

        if ($super_user) {

            $user = User::where("id", '=', $user_id)->first();
            $affiliate = Affiliate::where("id", '=', $affiliate_id)->first();
            $affiliate_user = User::where("id", '=', $affiliate->user_id)->first();
            // return response()->json(["success" => false, "message" => $affiliate_user]);
/*            return response()->json(["success" => false, "message" => [
                "user" => $user,
                "affiliate_user" => $affiliate_user,
            ]]);*/

            $util = new UserAffiliateAssociate();
            $res = $util->swapAffiliate($user, $affiliate_user, $affiliate);

            return response()->json(["success" => $res["success"], "message" => $res["message"]]);

            return response()->json(["success" => false, "message" => "user's affiliate reassigned successfully."]);

        }
        return response()->json(["success" => false, "message" => "you are not super user."]);
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
