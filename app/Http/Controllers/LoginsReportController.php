<?php

namespace App\Http\Controllers;

// use App\Models\ProfileUser;
use App\Models\Affiliate;
use App\Models\LoginsLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class LoginsReportController extends BackendController
{
    const ADMIN_USER = 3;
    const MANAGER_USER = 4;
    const PRODUCT_USER = 5;
    const eventIds = [
        1 //,2,12,13
    ];

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
       // request()->user()->authorizeRoles(['affiliate']);

        $user = Auth::user();

        if ($user->is_affiliate()) {
            $affiliate = Affiliate::find($user->affiliate_id);

            if ($affiliate) {

                $logs = $this->getAffiliateUsersEvents($affiliate);

                return View::make('reports.login-report', [
                    'logs' => $logs,
                    'userString' => json_encode($user),
                ]);

                return view('reports.login-report', compact('user'));
            }
        }

    }


    private function getAffiliateUsersEvents(Affiliate $affiliate)
    {
        // \DB::enableQueryLog();
        // return LoginsLog::where('affiliate_id', '=', $affiliate->id)->get();
        return LoginsLog::where('affiliate_id', '=', $affiliate->id)->whereIn('event_id', self::eventIds)->orderBy('created_at', 'DESC')
            ->paginate(
                intval(config('agentquote.affiliates.lists.pagination.items'))
            );

    }

}
