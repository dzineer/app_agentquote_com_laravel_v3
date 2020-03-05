<?php

namespace App\Http\Controllers;

// use App\Models\ProfileUser;
use App\Models\Affiliate;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\LoginsLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class EventsReportController extends BackendController
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

            $logs = $this->getAffiliateUsersEvents($affiliate);

            return View::make('reports.events-report', [
                'logs' => $logs
            ]);

            return view('reports.events-report', compact('logs'));
        }
    }


    private function getAffiliateUsersEvents(Affiliate $affiliate)
    {
        // \DB::enableQueryLog();
        // return LoginsLog::where('affiliate_id', '=', $affiliate->id)->get();
        return LoginsLog::where('affiliate_id', '=', $affiliate->id)->orderBy('created_at', 'DESC')
            ->paginate(
                intval(config('agentquote.affiliates.lists.pagination.items'))
            );

    }

}
