<?php

namespace App\Http\Controllers;

use App\AgentUser;
use App\Models\Affiliate;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\GroupUser;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    const MANAGER_USER = 4;
    const PRODUCT_USER = 5;

    public function index(Request $request)
    {

        $user = Auth::user();

        if ($user->is_super()) {

            $affiliate_id = 0;

            $user_type = $user->type_id;

            $sorts = [
                'fname', 'lname', 'email', 'date', 'group', 'last_login_at'
            ];

            $orders = [
                'asc', 'desc'
            ];

            $groupsArr = AffiliateGroup::all();

            $groups = json_encode($groupsArr);

            // return response()->json([$request->all()]);

            if ($request->has('sortby') && $request->has('order')) {

                $sortBy = $request->input('sortby');

                if ($sortBy === 'date') {
                    $sortBy = 'created_at';
                }

                if ($sortBy === 'last_login') {
                    $sortBy = 'last_login_at';
                }

                if ( in_array($sortBy,  $sorts) && in_array($request->input('order'), $orders)) {

                    $users_with_pagination = $this->getUsers($sortBy, $request->input('order'));

                } else {
                    $users_with_pagination = $this->getUsers();
                }

            } else {
                $users_with_pagination = $this->getUsers();
            }

            $pagination = $users_with_pagination['pagination'];
            $pagination->pages = new \stdClass();
            $pagination->pages = $this->genPages($pagination);

            $affiliates = Affiliate::select('id','name')->get();

            $json = response()->json([
                'user' => $user,
                'affiliate_id' => $affiliate_id,
                'affiliates' => $affiliates,
                'users' => $users_with_pagination['agents'],
                'pagination' => json_encode($pagination),
                'user_type' => 1,
            ]);

            // return $json;

            return View::make('users.users-affiliate-table', [
                'user' => $user,
                'affiliate_id' => $affiliate_id,
                'affiliates' => json_encode($affiliates),
                'users' => json_encode($users_with_pagination['agents']),
                'pagination' => json_encode($users_with_pagination['pagination']),
                'user_type' => 1,
            ]);

            return view('users.users-affiliate-table', compact('user', 'affiliate_id', 'users', 'groups', 'user_type') );

        }
        else if ($user->is_affiliate())
        {
            $affiliate = Affiliate::find($user->affiliate_id);
            $affiliate_id = $affiliate->id;

            /*        $users = array_filter($users, function($user) {
                        return $user->is_admin();
                    });*/

            $sorts = [
                'fname', 'lname', 'email', 'date', 'group'
            ];

            $orders = [
                'asc', 'desc'
            ];

            $users_with_pagination = [];

            if ($request->has('sortby') && $request->has('order')) {
                $sortBy = $request->input('sortby');

                if ($sortBy === 'date') {
                    $sortBy = 'created_at';
                }

                if ( in_array($sortBy,  $sorts) &&
                    in_array($request->input('order'), $orders)) {
                    $users_with_pagination = $this->getAffiliateUsersWithPagination($affiliate, $sortBy, $request->input('order'));
                } else {
                    $users_with_pagination = $this->getAffiliateUsersWithPagination($affiliate);
                }
            } else {
                $users_with_pagination = $this->getAffiliateUsersWithPagination($affiliate);
            }

            $user_type = $user->type_id;

            $pages = $this->genPages($users_with_pagination['pagination']);

            $groups = AffiliateGroup::where('affiliate_id', '=', $affiliate_id)->get()->toArray();

            $pagination = $users_with_pagination['pagination'];

            $pagination->pages = new \stdClass();
            $pagination->pages = $pages;

            // return response()->json(  ["user" => $user, "users" => json_encode($users_with_pagination['agents']), "pagination" => json_encode($pagination), "groups" => json_encode($groups), "affiliate_id" => $affiliate_id] );

            return view('users.users-list', [
                "user" => $user,
                "users" => json_encode($users_with_pagination['agents']),
                "pagination" => json_encode($pagination),
                "groups" => json_encode($groups),
                "affiliate_id" => $affiliate_id,
                "user_type" => $user_type
            ] );
        }
        else if ($user->is_admin())
        {
            $affiliate = Affiliate::find($user->affiliate_id);
            $affiliate_id = $affiliate->id;

            /*        $users = array_filter($users, function($user) {
                        return $user->is_admin();
                    });*/

            $sorts = [
                'fname', 'lname', 'email', 'date', 'group'
            ];

            $orders = [
                'asc', 'desc'
            ];

            $users_with_pagination = [];

            if ($request->has('sortby') && $request->has('order')) {
                $sortBy = $request->input('sortby');

                if ($sortBy === 'date') {
                    $sortBy = 'created_at';
                }

                if ( in_array($sortBy,  $sorts) &&
                    in_array($request->input('order'), $orders)) {
                    $users_with_pagination = $this->getAffiliateUsersWithPagination($affiliate, $sortBy, $request->input('order'));
                } else {
                    $users_with_pagination = $this->getAffiliateUsersWithPagination($affiliate);
                }
            } else {
                $users_with_pagination = $this->getAffiliateUsersWithPagination($affiliate);
            }

            $user_type = $user->type_id;

            $pages = $this->genPages($users_with_pagination['pagination']);

            $groups = AffiliateGroup::where('affiliate_id', '=', $affiliate_id)->get()->toArray();

            $pagination = $users_with_pagination['pagination'];

            $pagination->pages = new \stdClass();
            $pagination->pages = $pages;

            // return response()->json(  ["user" => $user, "users" => json_encode($users_with_pagination['agents']), "pagination" => json_encode($pagination), "groups" => json_encode($groups), "affiliate_id" => $affiliate_id] );

            return view('users.users-list', [
                "user" => $user,
                "users" => json_encode($users_with_pagination['agents']),
                "pagination" => json_encode($pagination),
                "groups" => json_encode($groups),
                "affiliate_id" => $affiliate_id,
                "user_type" => $user_type
            ] );
        }
        else if ($user->is_manager())
        {
            $affiliate = Affiliate::find($user->affiliate_id);
            $affiliate_id = $affiliate->id;

            /*        $users = array_filter($users, function($user) {
                        return $user->is_admin();
                    });*/

            $sorts = [
                'fname', 'lname', 'email', 'date', 'group'
            ];

            $orders = [
                'asc', 'desc'
            ];

            $users_with_pagination = [];

            if ($request->has('sortby') && $request->has('order')) {
                $sortBy = $request->input('sortby');

                if ($sortBy === 'date') {
                    $sortBy = 'created_at';
                }

                if ( in_array($sortBy,  $sorts) &&
                    in_array($request->input('order'), $orders)) {
                    $users_with_pagination = $this->getAffiliateGroupUsersWithPagination($affiliate, $user, $sortBy, $request->input('order'));
                } else {
                    $users_with_pagination = $this->getAffiliateGroupUsersWithPagination($affiliate, $user);
                }
            } else {
                $users_with_pagination = $this->getAffiliateGroupUsersWithPagination($affiliate, $user);
            }

            $user_type = $user->type_id;

            $pages = $this->genPages($users_with_pagination['pagination']);

            $groups = AffiliateGroup::where('affiliate_id', '=', $affiliate_id)->get()->toArray();

            $pagination = $users_with_pagination['pagination'];

            $pagination->pages = new \stdClass();
            $pagination->pages = $pages;

            // return response()->json(  ["user" => $user, "users" => json_encode($users_with_pagination['agents']), "pagination" => json_encode($pagination), "groups" => json_encode($groups), "affiliate_id" => $affiliate_id] );

            return view('users.users-list', [
                "user" => $user,
                "users" => json_encode($users_with_pagination['agents']),
                "pagination" => json_encode($pagination),
                "groups" => json_encode($groups),
                "affiliate_id" => $affiliate_id,
                "user_type" => $user_type
            ] );
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
        // dd($affiliate);

        if ($sortBy === 'id') {

            $agents = \DB::table('users')
                ->select('users.id as user_id', 'users.type_id as type_id', 'users.fname', 'users.lname', 'users.email', 'affiliate_groups.id as group_id', 'affiliate_groups.name as group', 'users.created_at')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->where('users.type_id', '=', self::PRODUCT_USER)
                ->where('users.affiliate_id', '=', $affiliate->id)
                //->orderBy('users.created_at', 'desc')->get();
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

        //$results = \DB::getQueryLog();
        //dd($results);
        // dd($agents);

        $users_with_pagination = json_decode(json_encode($agents));

        foreach($users_with_pagination->data as $key => $user) {
            $user->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans();
            $users_with_pagination->data[$key] = $user;
        }

        $users = $users_with_pagination->data;
        unset( $users_with_pagination->data );

        return ["agents" => $users, "pagination" => $users_with_pagination ];
    }

    private function getUsers($sortBy='last_login_at', $order='desc')
    {
        if ($sortBy === 'last_login_at') {

            $agents = \DB::table('users')
                ->select('users.id as user_id','users.affiliate_id as affiliate_id','users.active as active','users.type_id as type_id', 'users.fname', 'users.lname', 'users.email', 'users.last_login_at', 'users.created_at','affiliates.name as affiliate_name','affiliate_groups.id as group_id')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->leftJoin('affiliates', 'affiliates.id', '=', 'users.affiliate_id')
                ->where('users.type_id', '=', self::PRODUCT_USER)
                ->orderBy($sortBy, 'desc')
                ->paginate(10);

        }
        else {
            $agents = \DB::table('users')
                ->select('users.id as user_id', 'users.affiliate_id as affiliate_id', 'users.active as active', 'users.type_id as type_id', 'users.fname', 'users.lname', 'users.email', 'users.last_login_at', 'users.created_at', 'affiliates.name as affiliate_name', 'affiliate_groups.id as group_id')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->leftJoin('affiliates', 'affiliates.id', '=', 'users.affiliate_id')
                ->where('users.type_id', '=', self::PRODUCT_USER)->orderBy($sortBy, $order)->paginate(10);

        }

        // dd($agents);

        $users_with_pagination = json_decode(json_encode($agents));

        // dd($users_with_pagination);

        foreach($users_with_pagination->data as $key => $user) {
            //             $quote->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->isoFormat('LLL');
            $user->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->isoFormat('LLL');
            if ($user->last_login_at === null) {
                $user->last_login_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->isoFormat('LLL');
            } else {
                $user->last_login_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->last_login_at))->isoFormat('LLL');
            }

            $users_with_pagination->data[$key] = $user;
        }

        $users = $users_with_pagination->data;
        unset( $users_with_pagination->data );

        // dd(["agents" => $users, "pagination" => $users_with_pagination ]);

        return ["agents" => $users, "pagination" => $users_with_pagination ];
    }

    private function getAffiliateUsers(Affiliate $affiliate, $user)
    {
        // \DB::enableQueryLog();

        // dd($user);

        $agents = [];

        if ($user->type_id === self::MANAGER_USER) {

            $aff_group_user = AffiliateGroupUser::where('user_id', '=', $user->id)->first();

            if( $aff_group_user ) {

                $agents = \DB::table('users')
                    ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.created_at','affiliate_groups.id as group_id')
                    ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                    ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                    ->where('users.type_id', '=', self::PRODUCT_USER)
                    ->where('users.affiliate_id', '=', $affiliate->id)
                    ->where('affiliate_groups.id', '=', $aff_group_user->group_id)
                    ->get();
            }

        }
        else {
            $agents = \DB::table('users')
                ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'users.created_at','affiliate_groups.id as group_id')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->where('users.type_id', '=', self::PRODUCT_USER)
                ->where('users.affiliate_id', '=', $affiliate->id)
                ->get();
        }

        // dd($admins);

        $users = [];
        foreach($agents as $agent) {
            $agent->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($agent->created_at))->diffForHumans();
            $agent->password = '';

            $users[] = $agent;
        }

       //  dd($agents);

        // $users = array_merge($users, $users);
        // $queries = \DB::getQueryLog();

        return $users;
    }

}
