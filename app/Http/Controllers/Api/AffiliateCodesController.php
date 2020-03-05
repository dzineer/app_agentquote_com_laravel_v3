<?php

namespace App\Http\Controllers\Api;

use App\Models\Affiliate;
use App\Models\AffiliateCoupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AffiliateCodesController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $super_user = Auth::user();

        $affiliate = Affiliate::findOrFail($id);

/*        return response()->json([
            'success' => false,
            'message' => $affiliate
        ]);*/

        if (!$super_user->is_super()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $data = $this->validate($request, [
            'code' => 'required'
        ]);

        if ($super_user) {

            $affiliateData = [
                'affiliate_id' => $affiliate->id,
                "coupon" => $data['code'],
                'billing_coupon_id' => self::MY_MOBILE_LIFE_QUOTER,
            ];

            $affiliateCoupon = AffiliateCoupon::updateOrCreate([
                'affiliate_id' => $affiliate->id,
                'billing_coupon_id' => self::MY_MOBILE_LIFE_QUOTER,
            ], $affiliateData);

            return response()->json([
                "success" => true, "message" => "Coupon updated successfully."
            ]);

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
