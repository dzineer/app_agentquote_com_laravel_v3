<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AffiliateContract;
use App\Mail\AffiliateCodeNotification;
use App\Models\Affiliate;
use App\Models\AffiliateCoupon;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SuperAffiliateCodesController extends Controller
{
    const TOKEN_STRENGTH = 16;
    const ADMIN_USER_TYPE = 3;

    public function index(Request $request, $id)
    {
        $affiliate_id = $id;
        $super_user = Auth::user();

        if (!$super_user->is_super()) {
            return response()->json(["success" => false, "message" => "Invalid request."]);
        }

        $affiliate = Affiliate::where("id", '=', $affiliate_id)->first();

        if (!$affiliate) {
            return response()->json(["success" => false, "message" => "Invalid request."]);
        }

        $user = User::where("id", '=', $affiliate->user_id)->first();

        if (! $user) {
            return response()->json(["success" => false, "message" => "User does not exist!"]);
        }

        $affiliate_coupon = AffiliateCoupon::where('affiliate_id', '=', $affiliate->id)->first();

        $data = array_merge(['coupon_code' => $affiliate_coupon->coupon, 'type_id' => $user->type_id, 'user_id' => $user->id, 'type' => 'user']);

        // return response()->json(["success" => true, "message" => $data ]);

        \Mail::to($user['email'], $user['fname'])->send(new AffiliateCodeNotification(
            new AffiliateContract($user['fname'], $user['lname'], $user['email'], $affiliate_coupon->coupon)
        ));

        return response()->json(["success" => true, "message" => "Affiliate coupon code notification sent successfully." ]);
    }
}
