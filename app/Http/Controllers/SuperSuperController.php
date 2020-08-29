<?php

namespace App\Http\Controllers;

use App\AgentUser;
use App\Models\Affiliate;
use App\Models\AffiliateCoupon;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\GroupUser;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class SuperSuperController extends Controller
{
    const SUPER_SUPER_USER = 999;
    const MANAGER_USER = 4;
    const PRODUCT_USER = 5;
    const AFFILIATE_USER = 2;

    public function index(Request $request)
    {
        $user = Auth::user();


        // echo \DB::getDatabaseName();

        if ($user->is_super_super()) {

            $affiliate_id = 0;

            $user_type = $user->type_id;

            $users = User::where('type_id', '<>', self::SUPER_SUPER_USER)->get();

            // return $json;

            return View::make('super-super.users-index', [
                'user' => $user,
                'users' => $users,
            ]);

        }

    }

    public function loginAsUser(Request $request)
    {

        dd($request->all());

        $user = Auth::user();

        $data = $this->validate($request, [
            'user'
        ]);

        // echo \DB::getDatabaseName();

        if ($user->is_super_super()) {

            Auth::loginUsingId(intVal($request->input('user')));

            dd(Auth::user());

            return redirect()->action(
                'HomeController@index2', []
            );

        }

    }

    private function genPages($pagination) {
        $pages = [];

        $params = http_build_query(request()->except('page'));

        for ($page = 1; $page <= $pagination->last_page; $page++) {
            // request()->except('page')
            if (strlen($params)) {
                $pages[$page] = $pagination->path.'?'.$params.'&'.'page='.$page;
            } else {
                $pages[$page] = $pagination->path . '?'.'page='.$page;
            }
        }

        // dd($pages);

        return $pages;
    }

    private function getAffiliateGroupUsersWithPagination($affiliate, $user, $sortBy='id', $order = 'asc')
    {
        // \DB::enableQueryLog();
        $agents = [];

        $aff_grp_user = AffiliateGroupUser::where('user_id', '=', $user->id)->first();
        // dd($aff_grp_user);

        if ($sortBy === 'id') {

            $agents = \DB::table('users')
                ->select('users.id as user_id', 'users.type_id as type_id', 'users.fname', 'users.lname', 'users.email', 'affiliate_groups.id as group_id', 'affiliate_groups.name as group', 'users.created_at')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->where('users.type_id', '=', self::PRODUCT_USER)
                ->where('users.affiliate_id', '=', $affiliate->id)
                ->where('affiliate_groups.id', '=', $aff_grp_user->group_id)
                ->paginate(intval(config('agentquote.affiliates.lists.pagination.items')));

        } else {

            $agents = \DB::table('users')
                ->select('users.id as user_id', 'users.type_id as type_id', 'users.fname', 'users.lname', 'users.email', 'affiliate_groups.id as group_id', 'affiliate_groups.name as group', 'users.created_at')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->where('users.type_id', '=', self::PRODUCT_USER)
                ->where('users.affiliate_id', '=', $affiliate->id)
                ->where('affiliate_groups.id', '=', $aff_grp_user->group_id)
                ->orderBy($sortBy, $order)
                ->paginate(intval(config('agentquote.affiliates.lists.pagination.items')));
        }

        $users_with_pagination = json_decode(json_encode($agents));

        foreach($users_with_pagination->data as $key => $user) {
            $user->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans();
            $users_with_pagination->data[$key] = $user;
        }

        $users = $users_with_pagination->data;
        unset( $users_with_pagination->data );

        return ["agents" => $users, "pagination" => $users_with_pagination ];
    }

    private function getAffiliateUsersWithPagination($affiliate, $sortBy='id', $order = 'asc')
    {
        // \DB::enableQueryLog();
        $agents = [];

        if ($sortBy === 'id') {

            $agents = \DB::table('users')
                ->select('users.id as user_id', 'users.type_id as type_id', 'users.fname', 'users.lname', 'users.email', 'affiliate_groups.id as group_id', 'affiliate_groups.name as group', 'users.created_at')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->where('users.type_id', '=', self::PRODUCT_USER)
                ->where('users.affiliate_id', '=', $affiliate->id)
                ->paginate(intval(config('agentquote.affiliates.lists.pagination.items')));

        } else {

            $agents = \DB::table('users')
                ->select('users.id as user_id', 'users.type_id as type_id', 'users.fname', 'users.lname', 'users.email', 'affiliate_groups.id as group_id', 'affiliate_groups.name as group', 'users.created_at')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->where('users.type_id', '=', self::PRODUCT_USER)
                ->where('users.affiliate_id', '=', $affiliate->id)
                ->orderBy($sortBy, $order)
                ->paginate(intval(config('agentquote.affiliates.lists.pagination.items')));

        }

        $users_with_pagination = json_decode(json_encode($agents));

        foreach($users_with_pagination->data as $key => $user) {
            $user->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans();
            $users_with_pagination->data[$key] = $user;
        }

        $users = $users_with_pagination->data;
        unset( $users_with_pagination->data );

        return ["agents" => $users, "pagination" => $users_with_pagination ];
    }

    private function getUsers()
    {
        $agents = \DB::table('users')
            ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.created_at','affiliate_groups.id as group_id')
            ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
            ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
            ->where('users.type_id', '=', self::PRODUCT_USER)
            ->paginate(10);

        return $agents;

        dd($agents);

        $users = [];
        foreach($agents as $agent) {
            $agent->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($agent->created_at))->diffForHumans();
            $agent->password = '';

            $users[] = $agent;
        }

        return $users;
    }

    public function codes() {

        $user = Auth::user();
        $coupons = $this->getAffiliateCoupons();

        /* return response()->json([
            ["user" => $user, "coupons" => $affiliate_coupons ]
        ]); */

        return view('affiliate.affiliates-codes-table', ["user" => $user, "coupons" => $coupons ]);
        $coupons = AffiliateCoupon::all();
        /*return response()->json([
            ["user" => $user, "coupons" => $coupons ]
        ]);*/
        return view('affiliate.affiliates-codes-table', ["user" => $user, "coupons" => $coupons ]);
    }

    private function getAffiliateCoupons($sortBy='created_at', $order='desc')
    {
        $coupons = \DB::table('affiliate_coupon')
            ->select('affiliate_coupon.id as id','affiliate_coupon.affiliate_id as affiliate_id' ,'affiliates.name as name', 'affiliate_coupon.coupon as coupon_code')
            ->leftJoin('affiliates', 'affiliates.id', '=', 'affiliate_coupon.affiliate_id')->get();

        return $coupons;
    }

    private function getAffiliates($sortBy='created_at', $order='desc')
    {

        /*
        ->select('affiliate_coupon.id as id','affiliate_coupon.affiliate_id as affiliate_id' ,'affiliates.name as name', 'affiliate_coupon.coupon as coupon_code')
            ->leftJoin('affiliates', 'affiliates.id', '=', 'affiliate_coupon.affiliate_id')->get();
        */

        $affiliates = \DB::table('users')
            ->select('users.id as user_id','users.active as active' ,'users.type_id as type_id', 'users.name as whole_name', 'users.fname', 'users.lname', 'users.email', 'users.last_login_at as last_login_at', 'users.created_at','affiliate_groups.id as group_id', 'affiliate_coupon.id as id','affiliate_coupon.affiliate_id as affiliate_id' ,'affiliates.name as name', 'affiliate_coupon.coupon as coupon_code')
            ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
            ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
            ->leftJoin('affiliate_coupon', 'affiliate_coupon.affiliate_id', '=', 'users.affiliate_id')
            ->leftJoin('affiliates', 'affiliates.id', '=', 'affiliate_coupon.affiliate_id')
            ->where('users.type_id', '=', self::AFFILIATE_USER)
            ->orderBy($sortBy, $order)
            ->paginate(100);

        $affiliates_with_pagination = json_decode(json_encode($affiliates));

        // return $affiliates;

        foreach($affiliates_with_pagination->data as $key => $user) {
            $user->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans();
            $user->last_login_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->last_login_at))->diffForHumans();
            $affiliates_with_pagination->data[$key] = $user;
        }

        $affiliates = $affiliates_with_pagination->data;
        unset( $affiliates_with_pagination->data );

        // dd(["affiliates" => $affiliates, "pagination" => $affiliates_with_pagination ]);

        return ["affiliates" => $affiliates, "pagination" => $affiliates_with_pagination ];
    }


}
