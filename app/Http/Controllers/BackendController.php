<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BackendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $loggedInUser;

    public function __construct() {

        $this->middleware('auth');

	    View::composer('*', function ($view) {
		    $user          = Auth::user();
		    $profile       = Profile::where('user_id', '=', $user->id)->first();
		    $view->with('user', $user);
		    $view->with('profile', $profile);
	    });

        $this->loggedInUser = Auth::user();

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param array $sorts
     * @param array $orders
     * @return array
     */
    public function generateQuotes(Request $request, array $sorts, array $orders): View
    {
        if ($request->has('sortby') && $request->has('order')) {
            $sortBy = $request->input('sortby');

            if ($sortBy === 'affiliate') {
                $sortBy = 'affiliate_id';
            }

            if (in_array($sortBy, $sorts) && in_array($request->input('order'), $orders)) {
                $quotes = $this->getAllRecentQuotes($sortBy, $request->input('order'));
            } else {
                $quotes = $this->getAllRecentQuotes($sortBy = 'id', $order = 'asc');
            }
        } else {
            $quotes = $this->getAllRecentQuotes($sortBy = 'id', $order = 'asc');
        }

        $affiliates = $this->getAllAffiliates();

        return View::make('super.reports.quotes-report', [
            'affiliates' => $affiliates,
            'quotes' => $quotes,
        ]);
    }
}
