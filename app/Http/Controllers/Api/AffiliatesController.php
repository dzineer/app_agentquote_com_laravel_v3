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

class AffiliatesController extends Controller
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

    private function getAffiliateCoupons($sortBy='created_at', $order='desc')
    {
        $coupons = \DB::table('affiliate_coupon')
            ->select('affiliate_coupon.id as id','affiliate_coupon.affiliate_id as affiliate_id' ,'affiliates.name as name', 'affiliate_coupon.coupon as coupon_code')
            ->leftJoin('affiliates', 'affiliates.id', '=', 'affiliate_coupon.affiliate_id')->get();

        return $coupons;
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
