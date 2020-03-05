<?php

namespace App\Http\Controllers;

use App\Libraries\MailBodyBuilder;
use App\Mail\NewQuoteReceivedMail;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\GroupUser;
use App\Models\UserSubdomain;
use App\Models\MessageUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class MessagesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->is_super()) {

            $users = $this->getUsers();
            // dd($users);
            $groups = AffiliateGroup::where("affiliate_id", '=', 1)->get();
            $usersString = json_encode($users);
            // dd($usersString);
            return view('messages.new-message', ["usersString" => $usersString, "users" => $users, "groups" => $groups]);
        }
        else if ($user->is_affiliate()) {

            $users = $this->getUsers();
            // dd($users);
            $groups = AffiliateGroup::where("affiliate_id", '=', 1)->get();
            $usersString = json_encode($users);
            // dd($usersString);
            return view('messages.new-message', ["usersString" => $usersString, "users" => $users, "groups" => $groups]);

        }
        else if ($user->is_admin()) {

            $users = $this->getUsers();
            // dd($users);
            $groups = AffiliateGroup::where("affiliate_id", '=', 1)->get();
            $usersString = json_encode($users);
            // dd($usersString);
            return view('messages.new-message', ["usersString" => $usersString, "users" => $users, "groups" => $groups]);

        }
        else if ($user->is_manager()) {

            $users = $this->getUsersInGroup();
            // dd($users);
            $usersString = json_encode($users);
            // dd($usersString);
            return view('messages.new-message-manager', ["usersString" => $usersString, "users" => $users]);

        } else {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized request.",
            ]);
        }
   }

   // TODO: (BUG) fix this bug, not showing groups correctly
    private function getUsersInGroup()
    {
        // get managers's ground__id
        $managerGroupId = AffiliateGroupUser::where("user_id", '=', auth()->user()->id)->first()->group_id;

        // get all affiliates's agents
        $agents = User::where('affiliate_id', '=', auth()->user()->affiliate_id)->get();

        $agentWithGroups = [];

        foreach($agents as $agent) {
            // get agent's group_id
            $affiliateGroupUser = AffiliateGroupUser::where("user_id", '=', $agent->id)->first();

            // we only want users in manager's group
            // and dont' get the group's account
            if ($affiliateGroupUser->group_id === $managerGroupId && $agent->id !== auth()->user()->id) {
                $affiliateGroup = AffiliateGroup::where("id", '=', $managerGroupId)->first();
                $data = new \stdClass();
                $data->account = $agent;
                $data->group = $affiliateGroup;
                $agentWithGroups[] = $data;
            }
        }

        return $agentWithGroups;
    }

    private function getUsers()
    {
        $agents = User::where('affiliate_id', '=', auth()->user()->affiliate_id)->get();

        $agentWithGroups = [];

        foreach($agents as $agent) {
            $affiliateGroupUser = AffiliateGroupUser::where("user_id", '=', $agent->id)->first();
            $affiliateGroup = AffiliateGroup::where("id", '=', $affiliateGroupUser->group_id)->first();
            $data = new \stdClass();
            $data->account = $agent;
            $data->group = $affiliateGroup;
            $agentWithGroups[] = $data;
        }

        return $agentWithGroups;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($name, Request $request)
    {
	    $data = $this->validate($request, [
		    'name' => 'min:2',
		    'phone' => 'min:5,max:15',
		    'email' => 'min:6,max:30',
		    'message' => 'min:1,max:2000'
	    ]);

	    $rules = [
		    'name' => 'min:2',
		    'phone' => 'min:5,max:15',
		    'email' => 'min:6,max:30',
		    'message' => 'min:1,max:2000'
	    ];

	    $validator = Validator::make($data, $rules);

	    if ($validator->fails()) {
	        return response()->json(['failed' => true, "message" => "Message was not sent."]);
	    }

	    $subdomain = UserSubdomain::where("name", "=", $name)->first();
	    if ($subdomain)
	    { // let's get the user now and their profile
		    $user = User::find($subdomain->user_id);
		    if ($user)
		    {
			    $message = array_merge($data, ["user_id" => $user->id ]);
				MessageUser::create(
					$message
				);
			    return response()->json(['success' => true, "message" => "Message was sent."]);
		    } else {
			    return response()->json(['success' => true, "message" => "Message was sent."]);
		    }
	    } else {
		    return response()->json(['success' => true, "message" => "Message was sent."]);
	    }
    }

    public function search(Request $request) {
	    // return response()->json([$request->input('search')]);
	    $user = Auth::user();
	    $messages = MessageUser::where('user_id', '=', $user->id)->search('%'.$request->input('search').'%')->get();
	    if (count($messages)) {
		    return response()->json(["success" => true, "messages" => $messages, "message" => "Messages found."]);
	    } else
	    {
		    return response()->json(["failed" => true, "message" => "No messages found."]);
	    }
    }

}
