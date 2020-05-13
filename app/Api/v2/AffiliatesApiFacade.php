<?php


namespace App\Api\v2;

use App\AdminUser;
use App\Facades\AQLog;
use App\Models\Affiliate;
use App\Models\AffiliateGroupUser;
use App\User;

/**
 * Class AffiliatesApiFacade
 * @package App\Api
 */
class AffiliatesApiFacade
{
    /**
     *
     */
    const AFFILIATE_USER = 2;
    /**
     *
     */
    const MY_MOBILE_LIFE_QUOTER = 1;

    public function storeAffiliate($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        if (AdminUser::where($data)->exists()) {
            return response()->json(["success" => false, "message" => "Affiliate already exists."]);
        }

        $affiliate = Affiliate::where('id', '=', $data['affiliate_id'])->first();

        if ($affiliate) {

            $aff_group = AffiliateGroupUser::where([
                'affiliate_id' => $data['affiliate_id'],
            ]);

            if ($aff_group) {

                $random_password = \Illuminate\Support\Str::random(self::PASSWORD_STRENGTH);
                $hashed_random_password = \Illuminate\Support\Facades\Hash::make($random_password);

                $admin = AdminUser::create([
                    'fname' => $data['fname'],
                    'lname' => $data['fname'],
                    'email' => $data['email'],
                    'password' => $hashed_random_password,
                    'affiliate_id' => $affiliate->id
                ]);

                AffiliateGroupUser::create([
                    'affiliate_id' => $data['name'],
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

        return response()->json([
            "message" => "Affiliate received.",
            "success" => true,
        ]);


    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAffiliate($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "success" => false,
            ]);
        }

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
                "success" => false,
            ]);
        }

        return response()->json([
            "message" => "Affiliate received.",
            "success" => true,
        ]);


    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function disableAffiliate($data)
    {

        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "success" => false,
            ]);
        }

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
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
            "success" => true,
        ]);


    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function enableAffiliate($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "success" => false,
            ]);
        }

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
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
            "success" => true,
        ]);
    }

}
