<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Models\Affiliate;
use App\Models\AffiliateGroup;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    const ADMIN_USER = 3;

    public function index(Request $request) {
        // Auth::loginUsingId(5);

        /*        \DB::listen(function($sql) {
                    dnd($sql);
                });*/


        $user = Auth::user();
        $affiliate = Affiliate::find($user->affiliate_id);
        $affiliate_id = $affiliate->id;

        $sorts = [
            'fname', 'lname', 'email', 'date', 'group'
        ];

        $orders = [
            'asc', 'desc'
        ];

/*        $admins = array_filter($users, function($user) {
            return $user->is_admin();
        });*/

        if ($request->has('sortby') && $request->has('order')) {
            $sortBy = $request->input('sortby');

            if ($sortBy === 'date') {
                $sortBy = 'created_at';
            }

            if ( in_array($sortBy,  $sorts) &&
                in_array($request->input('order'), $orders)) {
                $admins_with_pagination = $this->getAffiliateAdminsWithPagination($affiliate, $sortBy, $request->input('order'));
            } else {
                $admins_with_pagination = $this->getAffiliateAdminsWithPagination($affiliate);
            }
        } else {
            $admins_with_pagination = $this->getAffiliateAdminsWithPagination($affiliate);
        }

        $pages = $this->genPages($admins_with_pagination['pagination']);

        $groups = AffiliateGroup::where('affiliate_id', '=', $affiliate_id)->get()->toArray();

        $pagination = $admins_with_pagination['pagination'];

        $pagination->pages = new \stdClass();
        $pagination->pages = $pages;

        // return response()->json($admins_with_pagination);

        // return response()->json(  ["user" => $user, "admins" => $admins_with_pagination['admins'], "pagination" => $pagination, "groups" => $groups, "affiliate_id" => $affiliate_id]  );

        return view('admins.admins-list', ["user" => $user, "admins" => json_encode($admins_with_pagination['admins']), "pagination" => json_encode($pagination), "groups" => json_encode($groups), "affiliate_id" => $affiliate_id] );
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

    private function getAffiliateAdminsWithPagination($affiliate, $sortBy='id', $order = 'asc')
    {
       // \DB::enableQueryLog();
        $admins = [];

        if ($sortBy === 'id') {

            $admins = \DB::table('users')
                ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'affiliate_groups.id as group_id', 'affiliate_groups.name as group', 'users.created_at')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->where('users.type_id', '=', self::ADMIN_USER)
                ->where('users.affiliate_id', '=', $affiliate->id)
                ->paginate(intval(config('agentquote.super.lists.pagination.items')));

        } else {

            $admins = \DB::table('users')
                ->select('users.id as user_id', 'users.fname', 'users.lname', 'users.email', 'affiliate_groups.id as group_id', 'affiliate_groups.name as group', 'users.created_at')
                ->leftJoin('affiliate_group_users', 'users.id', '=', 'affiliate_group_users.user_id')
                ->leftJoin('affiliate_groups', 'affiliate_group_users.group_id', '=', 'affiliate_groups.id')
                ->where('users.type_id', '=', self::ADMIN_USER)
                ->where('users.affiliate_id', '=', $affiliate->id)
                ->orderBy($sortBy, $order)
                ->paginate(intval(config('agentquote.super.lists.pagination.items')));

        }

        $users_with_pagination = json_decode(json_encode($admins));

        foreach($users_with_pagination->data as $key => $user) {
            $user->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans();
            $users_with_pagination->data[$key] = $user;
        }

        $users = $users_with_pagination->data;
        unset( $users_with_pagination->data );

        return ["admins" => $users, "pagination" => $users_with_pagination ];
    }
}
