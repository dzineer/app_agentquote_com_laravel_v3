<?php

namespace App\Http\Controllers;

// use App\Models\ProfileUser;
use App\Libraries\AgentRecentQuotes;
use App\Libraries\AffiliateAgentsQuotes;
use App\Libraries\SuperRecentQuotes;

use App\Models\Affiliate;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\Carrier;
use App\Models\CarriersQuote;
use App\Models\QuoteUsers;
use App\Traits\QuotesPagination;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Auth\Authenticatable;


class RecentQuotesController extends BackendController
{
    use QuotesPagination;

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

    public function index(Request $request)
    {
        // request()->user()->authorizeRoles(['affiliate, agents']);

        return $this->dispatchQuoteReport($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @return \Illuminate\Contracts\View\View
     */
    private function getRecentAffiliateQuotes(
        Request $request,
        Authenticatable $user
    ): \Illuminate\Contracts\View\View {
        $affiliate = Affiliate::find($user->affiliate_id);
        if ($affiliate) {
            $affiliate_agent_quotes = new AffiliateAgentsQuotes();

            return $affiliate_agent_quotes->generateQuotes($request, $affiliate, $user);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @return \Illuminate\Contracts\View\View
     */
    private function getRecentQuotes(
        Request $request,
        Authenticatable $user
    ): \Illuminate\Contracts\View\View {
        $super_agent_quotes = new SuperRecentQuotes();

        return $super_agent_quotes->generateQuotes($request, $user);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @return \Illuminate\Contracts\View\View
     */
    private function getRecentAffiliateAgentQuotes(
        Request $request,
        Authenticatable $user
    ): \Illuminate\Contracts\View\View {
        $affiliate = Affiliate::find($user->affiliate_id);
        if ($affiliate) {
            $agentQuotes = new AgentRecentQuotes();
           // dd($affiliate);

            return $agentQuotes->generateQuotes($request, $affiliate, $user);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    private function dispatchQuoteReport(Request $request): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();

        if ($user->is_super()) {
            return $this->getRecentQuotes($request, $user);
        } else if ($user->is_affiliate()) {
            return $this->getRecentAffiliateQuotes($request, $user);
        } else if ($user->is_agent()) {
            return $this->getRecentAffiliateAgentQuotes($request, $user);
        }
    }
}