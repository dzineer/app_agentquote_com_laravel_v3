<?php

namespace App\Http\Controllers;

use App\AffiliateAdUnderwritten;
use App\Models\AffiliateAd;
use App\Models\Carrier;
use App\Models\CategoriesInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AffiliateAdSitController extends Controller
{
    const SIMPLIFIED_ISSUE_TERM = 2;
    const NEW_AD = 0;
    const COMPANY_NOT_SELECTED = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $carriers = Carrier::all();
        // Auth::loginUsingId(5);

        $carriers = CategoriesInsurance::getSitCarriers();

        $noCarrier = new \stdClass();
        $noCarrier->category_id = self::SIMPLIFIED_ISSUE_TERM;
        $noCarrier->company_id = 0;
        $noCarrier->name = "None";
        $noCarrier->link1 = "";
        $noCarrier->link2 = "";

        $final_carriers = array_merge([$noCarrier], $carriers);

        $user = Auth::user();

        $adItem = AffiliateAd::all()->filter(function($ad) use($user) {
            return $ad->category_id === self::SIMPLIFIED_ISSUE_TERM && $ad->affiliate_id === $user->affiliate_id;;
        })->first();

        $page = [];
        $page["header"] =  'SI Term Ad';

        $labels = new \stdClass();
        $labels->preferred_carrier_label = 'SI Term';
        $labels->running_ad_label = 'Running Ad';
        $labels->ad_label = 'Ad Text';
        $labels->save_button_text = 'Save';

        $ad = new \stdClass();
        $ad->id = self::NEW_AD;
        $ad->category_id = self::SIMPLIFIED_ISSUE_TERM;
        $ad->company_id = self::COMPANY_NOT_SELECTED;
        $ad->message = '';

        if ($adItem) {
            $ad->id = $adItem->category_id;
            $ad->category_id = $adItem->category_id;
            $ad->company_id = $adItem->company_id;
            $ad->message = $adItem->message;

            /*            foreach($carriers as $key => $company) {
                            if ($ad->company_id === $company->company_id ) {
                                $company->checked = true;
                             } else {
                                $company->checked = false;
                            }
                            $carriers[$key] = $company;
                        }*/

        }

        $adString = json_encode($ad);
        $carriersString = json_encode($final_carriers);
        $labelsString = json_encode($labels);

        //   dd($carriers);
        $url = route('affiliate.ad.sit.store');
        return view('ads.categories.sit', compact('url', 'user', 'carriers', 'page', 'labelsString', 'adString', 'carriersString'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return response()->json($request->all());
        // echo print_r($_POST,true); exit;
        // echo print_r($request->all()); exit;
        // Auth::loginUsingId(5);

        $user =  Auth::user();

        $data = $this->validate($request, [
            'company_id' => 'required',
            'message' => ''
        ]);

        // dd($res);

        $data['category_id'] = self::SIMPLIFIED_ISSUE_TERM;

        // return response()->json($data);

        // \DB::connection()->enableQueryLog();

        $affiliate_ad = AffiliateAd::updateOrCreate([
            'affiliate_id' => $user->affiliate->id,
            'category_id' => self::SIMPLIFIED_ISSUE_TERM
        ],
            $data
        );

        // $query_log = \DB::getQueryLog();

        // return response()->json(["successful" => true, "logs" => $query_log] );


        return response()->json(["success" => true, "message" => "Updated successfully."]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AffiliateAdUnderwritten  $affiliateAdUnderwritten
     * @return \Illuminate\Http\Response
     */
    public function show(AffiliateAdUnderwritten $affiliateAdUnderwritten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AffiliateAdUnderwritten  $affiliateAdUnderwritten
     * @return \Illuminate\Http\Response
     */
    public function edit(AffiliateAdUnderwritten $affiliateAdUnderwritten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AffiliateAdUnderwritten  $affiliateAdUnderwritten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AffiliateAdUnderwritten $affiliateAdUnderwritten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AffiliateAdUnderwritten  $affiliateAdUnderwritten
     * @return \Illuminate\Http\Response
     */
    public function destroy(AffiliateAdUnderwritten $affiliateAdUnderwritten)
    {
        //
    }
}