<?php

namespace App\Http\Controllers;

// use App\Models\ProfileUser;
use App\Models\Affiliate;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\Carrier;
use App\Models\CarriersQuote;
use App\Models\QuoteUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TopQuotedCarriersReportsController extends BackendController
{
    const ADMIN_USER = 3;
    const MANAGER_USER = 4;
    const PRODUCT_USER = 5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        request()->user()->authorizeRoles(['affiliate']);

        $user = Auth::user();

        $affiliate = Affiliate::find($user->affiliate_id);

        if ($affiliate) {

            $affiliate_id = $affiliate->id;

            $logs = [];

            $logs = $this->getCarriersQuoted($affiliate);

            /*if (request()->has('top') && strlen(request()->input('top')) ) {
                $top = intVal(request()->input('top'));
                $logs = $this->getCarriersQuoted($affiliate, $top);
            } else {
                $logs = $this->getCarriersQuoted($affiliate);
            }*/

            $carriers = [];

            $top_n_carriers_of_quotes = [];

            foreach($logs as $log) {

                $top_n_carriers_of_quotes = array_slice($log->carriers, 0, 4, true);;

                $carrier_ids = [];

/*                foreach($top_n_carriers_of_quotes as $carrier_id) {
                    $carrier = Carrier::where('company_id', '=', $carrier_id)->first();
                    if (! in_array($carrier->name, $carriers) ) {
                        $carrier_ids[] = $carrier->id;
                    }
                }*/

                foreach($top_n_carriers_of_quotes as $carrier_id) {
                    $carrier = Carrier::where('company_id', '=', $carrier_id)->first();
                    if (! in_array($carrier->name, $carriers) ) {
                        $carriers[] = $carrier->name;
                    }

                }
            }

            // return response()->json(["logs" => $logs, "carriers" => json_encode($carriers) ]);
            return View::make('reports.top-carriers-report', [
                'user' => $user,
                'carriers' => json_encode($carriers),
                'affiliate_id' => $affiliate_id,
                'pagination' => json_encode([]),
                'use_pagination' => 0
            ]);
            return view('reports.top-carriers-report', compact('user', 'carriers', 'affiliate_id'));
        }
    }

    private function getCarriersQuoted(Affiliate $affiliate, $top = 0)
    {
        // \DB::enableQueryLog();
        $carriers_quoted = [];

        $quotes_details = [];

        $quotes = QuoteUsers::where('affiliate_id', '=', $affiliate->id)->get();

        foreach($quotes as $quote) {

            $carrier_list = CarriersQuote::where('quote_id', '=', $quote->id)->first();

            $carrier_items = \unserialize($carrier_list->data);

            /*
            if( $top !== 0) {
                $carrier_items = array_slice($carrier_items, 0, $top, true);
            }*/

            $quoteItem = new \stdClass();
            $quoteItem->quote = $quote->toArray();
            $quoteItem->details = [];
            $quoteItem->carriers = $carrier_items;

            foreach($carrier_items as $carrier_id) {
                $detail = new \stdClass();
                $carrier = Carrier::where('company_id', '=', $carrier_id)->first();
                $detail->carrier_id = $carrier_id;
                $detail->carrier = $carrier->name;
                $quoteItem->details[] = $detail;
            }

            $quotes_details[] = $quoteItem;
        }

        return $quotes_details;
    }

}
