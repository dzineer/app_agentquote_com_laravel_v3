<?php

namespace App\Http\Controllers;

use App\AffiliateAdUnderwritten;
use App\Models\AffiliateAd;
use App\Models\Carrier;
use App\Models\CategoriesInsurance;
use App\Models\SuperAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperUserAdController extends Controller
{
    const UNDERWRITTEN_TERM = 1;
    const NEW_AD = 0;
    const COMPANY_NOT_SELECTED = 0;

    protected $table = 'super_ads';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        $adItem = SuperAd::first();

/*       return response()->json([
           "adItem" => $adItem
        ]);*/

        $page = [];
        $page["header"] =  'Header Ad';

        $labels = new \stdClass();
        $labels->preferred_carrier_label = 'Ad';
        $labels->running_ad_label = 'Running Ad';
        $labels->ad_label = 'Ad Text';
        $labels->save_button_text = 'Select Underwritten Preferred Carrier';

        $ad = new \stdClass();
        $ad->id = 0;
        $ad->message = '';

        if ($adItem) {
            $ad->id = $adItem->id;
            $ad->message = $adItem->body;
        }

/*        return response()->json(
            ["url" => config('agentquote.company.domain.urls.secure')]
        );*/

        $adString = json_encode($ad);
        $labelsString = json_encode($labels);

        $url = route('super.ad.store');

        // echo $url; exit;

/*        return response()->json(
            compact('url', 'adString', 'user', 'page', 'labelsString', 'adString')
        );*/

        return view('ads.super.super-ad', compact('url', 'user', 'page', 'labelsString', 'adString'));
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

        /*return response()->json([
            "path" => public_path() . '/images/'
        ]);*/

        $user =  Auth::user();

        if ($user->is_super()) {

/*            return response()->json([
                "data" => $request->all()
            ]);*/

            $data = $this->validate($request, [
                'id' => 'required',
                'message' => ''
            ]);

/*            if ($request->hasFile('file')) {
                $data['body'] = null;
                $moveTo = public_path() . '/images/';
                $request->file('file')->move($moveTo,$request->file('file')->getClientOriginalName());
                $data['image_url'] = '/images/' . $request->file('file')->getClientOriginalName();
            } else {
                $data['image_url'] = null;
            }*/

            SuperAd::updateOrCreate([
                'id' => $data['id']
            ],
                $data
            );

            return response()->json(["success" => true, "message" => "Updated successfully."]);
        }

        return response()->json(["success" => true, "message" => "Updated failed."]);

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
