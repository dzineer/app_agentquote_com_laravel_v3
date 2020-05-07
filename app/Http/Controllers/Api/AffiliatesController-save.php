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

/**
 * Class AffiliatesController
 * @package App\Http\Controllers\Api
 */
class AffiliatesController extends Controller
{
    /**
     *
     */
    const AFFILIATE_USER = 2;
    /**
     *
     */
    const MY_MOBILE_LIFE_QUOTER = 1;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getAffiliate(Request $request)
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

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        return response()->json([
            "message" => "Affiliate received.",
            "data" => $user,
            "success" => true,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function disableAffiliate(Request $request)
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

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user->affiliate->update([
            'active' => 0
        ]);

        $user->update([
            'active' => 0
        ]);

        return response()->json([
            "message" => "Affiliate disabled.",
            "data" => request()->all(),
            "success" => true,
        ]);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function enableAffiliate(Request $request)
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

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user->affiliate->update([
            'active' => 1
        ]);

        $user->update([
            'active' => 1
        ]);

        return response()->json([
            "message" => "Affiliate disabled.",
            "data" => request()->all(),
            "success" => true,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeAffiliate(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'name' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'code' => 'required'
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

        $newUser = [
            "type_id" => self::AFFILIATE_USER,
            "lname" => $data['lname'],
            "fname" => $data['fname'],
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => Hash::make($data['password'])
        ];

        $newUser['password'] =  Hash::make($data['password']);

        if( User::where([
            "email" => $data['email']
        ])->exists() ) {
            return response()->json([
                "message" => "User already exists. Try different email address.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        if( Affiliate::where([
            "name" => $data['name']
        ])->exists() ) {
            return response()->json([
                "message" => "Affiliate already exists. Try different Company Name.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        if( AffiliateGroup::where([
            "name" => $data['name']
        ])->exists() ) {
            return response()->json([
                "message" => "Affiliate Group already exists. Try different Company Name.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

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
            "message" => "Affiliate created successfully",
            "mode" => "debug",
            "ip" => request()->ip(),
            "ok" => true,
            "success" => true,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
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

    /**
     * @param string $sortBy
     * @param string $order
     * @return mixed
     */
    private function getAffiliateCoupons($sortBy='created_at', $order='desc')
    {
        $coupons = \DB::table('affiliate_coupon')
            ->select('affiliate_coupon.id as id','affiliate_coupon.affiliate_id as affiliate_id' ,'affiliates.name as name', 'affiliate_coupon.coupon as coupon_code')
            ->leftJoin('affiliates', 'affiliates.id', '=', 'affiliate_coupon.affiliate_id')->get();

        return $coupons;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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

}
