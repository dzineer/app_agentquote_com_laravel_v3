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

class AgentRecentQuotesController extends BackendController
{
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
        request()->user()->authorizeRoles(['user']);

        $user = Auth::user();

        $quotes = $this->getRecentQuotes($user);

        return View::make('users.reports.quotes-report', [
            'quotes' => $quotes
        ]);

      return view('users.reports.quotes-report', compact('quotes'));
    }

    private function getRecentQuotes($user)
    {

        $quotes = QuoteUsers::where('user_id', '=', $user->id)
            ->where('created_at', '>=', \Carbon\Carbon::today())
            ->paginate(
                intval(config('agentquote.agents.reports.pagination.items'))
            );
           // ->simplePaginate(3);

        return $quotes;
    }

}
