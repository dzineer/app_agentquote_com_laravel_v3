<?php

namespace App\Http\Controllers;

// use App\Models\ProfileUser;
use App\Models\Affiliate;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\LoginsLog;
use App\Models\QuoteUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends BackendController
{
    const AFFILIATE_USER = 2;
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
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//Role::create(['name' => 'writer']);
	    // $permission = Permission::findById(2);
    	// $role = Role::findById(1);
    	// $role->givePermissionTo($permission);
		// adding permission to user
	    // auth()->user()->givePermissionTo('write post');
	    // auth()->user()->givePermissionTo('edit post');
	    // assign role
	    // auth()->user()->assignRole('writer');
	    // return auth()->user()->getPermissionsViaRoles();
	    //return auth()->user()->getAllPermissions();
	    // return auth()->user()->getRoleNames();
	    // return auth()->user()->permissions;
	    // return User::role('writer')->get();
	    // return User::permission('write post')->get();
	    // return auth()->user()->revokePermissionTo('edit post');

        $user = User::findOrFail(auth()->id());
       // dd($user);
        // dd(env('DB_DATABASE'));
        return $this->getDashboard($user);
    }

    public function index2()
    {
        //Role::create(['name' => 'writer']);
        // $permission = Permission::findById(2);
        // $role = Role::findById(1);
        // $role->givePermissionTo($permission);
        // adding permission to user
        // auth()->user()->givePermissionTo('write post');
        // auth()->user()->givePermissionTo('edit post');
        // assign role
        // auth()->user()->assignRole('writer');
        // return auth()->user()->getPermissionsViaRoles();
        //return auth()->user()->getAllPermissions();
        // return auth()->user()->getRoleNames();
        // return auth()->user()->permissions;
        // return User::role('writer')->get();
        // return User::permission('write post')->get();
        // return auth()->user()->revokePermissionTo('edit post');

        $user = User::findOrFail(auth()->id());
        // dd($user);
        // dd(env('DB_DATABASE'));
        return $this->getDashboard($user);
    }

    private function getDashboard($user)
    {
        if ($user->is_super_super()) {

            // dd(["super super"]);

            $users = User::where('type_id', '<', 999)->get();

            return view('dashboards.super-super', compact('users'));
        } else if ($user->is_super()) {

            // dd(["super"]);

            $affiliate = Affiliate::find(1);

            $counts = $this->getSuperCounts();

            $user = Auth::user();

            $logs = $this->getAffiliateUsersEvents($affiliate);

            return view('dashboards.super', compact('counts','logs'));
        }
        else if ($user->is_agent()) {

            $quote_count = $this->getRecentAgentQuotes($user);

            return view('dashboards.user', compact('quote_count'));
        }
        else if ($user->is_manager()) {

            $affiliate = Affiliate::find($user->affiliate_id);

            if ($affiliate) {
                $counts = $this->getAffiliateCounts($affiliate);
                return view('dashboards.manager', compact('counts'));
            }
        }
        else if ($user->is_admin()) {
            $affiliate = Affiliate::find($user->affiliate_id);
            if ($affiliate) {
                $counts = $this->getAffiliateCounts($affiliate);
                return view('dashboards.admin', compact('counts'));
            }
        }
        else if ($user->is_affiliate()) {
            $affiliate = Affiliate::find($user->affiliate_id);

            $logs = [];

            if ($affiliate) {
                $counts = $this->getAffiliateCounts($affiliate);

                $user = Auth::user();

                $logs = $this->getAffiliateUsersEvents($affiliate);

                return view('dashboards.affiliate', compact('counts','logs'));
            }
        }
        else
            return abort(404);
    }

    private function getRecentAgentQuotes($user)
    {

        $n = QuoteUsers::where('user_id', '=', $user->id)
            ->where('created_at', '>=', \Carbon\Carbon::today())
            ->count();
        // ->simplePaginate(3);

        return $n;
    }

    private function getAffiliateCounts($affiliate) {
        $affiliates_count = $this->getUserTypeCount(self::AFFILIATE_USER);
        $admins_count = $this->getAffiliateTypeUsersCount($affiliate, self::ADMIN_USER);
        $managers_count = $this->getAffiliateTypeUsersCount($affiliate, self::MANAGER_USER);
        $agents_count = $this->getAffiliateTypeUsersCount($affiliate, self::PRODUCT_USER);
        $groups_count = AffiliateGroup::where('affiliate_id', '=', $affiliate->id)->get()->count();

        return [ "affiliates" => $affiliates_count, "groups" => $groups_count, "admins" => $admins_count, "managers" => $managers_count, "agents" => $agents_count];
    }

    private function getSuperCounts() {
        $affiliates_count = $this->getUserTypeCount(self::AFFILIATE_USER);
        $admins_count = $this->getUserTypeCount(self::ADMIN_USER);
        $managers_count = $this->getUserTypeCount(self::MANAGER_USER);
        $agents_count = $this->getUserTypeCount(self::PRODUCT_USER);
        $groups_count = AffiliateGroup::all()->count();

        return [ "affiliates" => $affiliates_count, "groups" => $groups_count, "admins" => $admins_count, "managers" => $managers_count, "agents" => $agents_count];
    }

    private function getUserTypeCount($type)
    {
        // \DB::enableQueryLog();

        $number = \DB::table('users')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.created_at','affiliate_groups.id as group_id')
            ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
            ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
            ->where('users.type_id', '=', $type)
            ->count();

        return $number;
    }

    private function getAffiliateTypeUsersCount($affiliate, $type)
    {
        // \DB::enableQueryLog();

        $number = \DB::table('users')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.created_at','affiliate_groups.id as group_id')
            ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
            ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
            ->where('users.type_id', '=', $type)
            ->where('users.affiliate_id', '=', $affiliate->id)
            ->count();

        return $number;
    }

    private function getAffiliateUsers(Affiliate $affiliate, $user)
    {
        // \DB::enableQueryLog();

        $agents = \DB::table('users')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.affiliate_id', 'users.created_at')
            ->where('users.affiliate_id', '=', $affiliate->id)
            ->get();

        $users = [];
        foreach($agents as $agent) {
            $agent->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($agent->created_at))->diffForHumans();
            $agent->password = '';

            $users[] = $agent;
        }

        // dd($users);
        // $users = array_merge($users, $users);
        // $queries = \DB::getQueryLog();

        return $users;
    }

    private function getAffiliateUsersEvents(Affiliate $affiliate)
    {
        // \DB::enableQueryLog();
        return LoginsLog::where('affiliate_id', '=', $affiliate->id)->get();

    }


}
