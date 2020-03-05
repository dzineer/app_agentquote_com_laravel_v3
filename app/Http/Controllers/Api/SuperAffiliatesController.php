<?php

namespace App\Http\Controllers\Api;

use App\Models\Affiliate;
use App\Models\AffiliateBillingCoupon;
use App\Models\AffiliateCoupon;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\RoleUser;
use App\User;
use Dzineer\LaravelAdminLte\Menu\Filters\SubmenuFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAffiliatesController extends Controller
{
    const AFFILIATE_USER = 2;
    const MY_MOBILE_LIFE_QUOTER = 1;

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
        $actions = [
            '1',
            '0'
        ];

        $super_user = Auth::user();

        if (!$super_user->is_super()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $data = $this->validate($request, [
            'name' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'code' => 'required'
        ]);

        $newUser = [
            "type_id" => self::AFFILIATE_USER,
            "lname" => $data['lname'],
            "fname" => $data['fname'],
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => Hash::make($data['password'])
        ];

        $newUser['password'] =  Hash::make($data['password']);

        if ($super_user) {
            $newUser = User::create($newUser);

            $newAffiliate = Affiliate::create([
                "name" => $data['name']
            ]);

            $affiliateCoupon = AffiliateCoupon::create([
                'affiliate_id' => $newAffiliate->id,
                "coupon" => $data['code'],
                'billing_coupon_id' => self::MY_MOBILE_LIFE_QUOTER,
            ]);

            $group = AffiliateGroup::create([
                'affiliate_id' => $newAffiliate->id,
                'name' => $data['name'],
                'description' => $data['name'],
            ]);

            $affgroupUser = AffiliateGroupUser::create([
                "affiliate_id" => $newAffiliate->id,
                "group_id" => $group->id,
                "user_id" => $newUser->id,
            ]);

            $affBBillingCoupon = AffiliateBillingCoupon::create([
                'affiliate_coupon_id' => $affiliateCoupon->id,
                'billing_coupon_id' => self::MY_MOBILE_LIFE_QUOTER,
            ]);

            $newUser->affiliate_id = $newAffiliate->id;
            $newAffiliate->user_id = $newUser->id;

            $newUser->save();
            $newAffiliate->save();

            $coupons = $this->getAffiliateCoupons();

            return response()->json([
                ["success" => true, "coupons" => $coupons ]
            ]);

        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid request'
        ]);
    }

    public function update(Request $request)
    {
/*        return response()->json([
            'success' => false,
            'message' => $request->all()
        ]);*/

        $super_user = Auth::user();

        if (!$super_user->is_super()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $data = $this->validate($request, [
            'affiliate_id' => 'required'
        ]);

        $affiliate = Affiliate::find($data['affiliate_id']);

        $updated = false;

        if ($affiliate) {
            $user = User::find($affiliate['user_id']);
            if ($user) {

                if ($request->has('name')) {
                    if(Affiliate::where('name', '=', $request->input('name'))->exists()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Affiliate name already being used.'
                        ]);
                    } else {
                        $affiliate->name = $request->input('name');
                        $affiliate->save();
                        $updated = true;
                    }
                }

                if($request->has('email')) {

                    if(User::where('email', '=',$request->input('email'))->exists()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Email already being used.'
                        ]);
                    } else {
                        $user->email = $request->input('email');
                        $user->save();
                        $updated = true;
                    }

                }

                if ($updated) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Affiliate updated successfully.'
                    ]);
                }


            }

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
