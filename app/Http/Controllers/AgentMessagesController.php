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

class AgentMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
    	$user = Auth::user();

        if ($user->is_agent()) {

            $messages = MessageUser::where('user_id', '=', $user->id)
                ->orderBy('created_at','desc')->paginate(8);

            // dd($messages);
            $new_messages = [];
            foreach($messages as $message) {
                $new_message = new \stdClass();
                foreach($message->getAttributes() as $key => $value) {

                    if ($key === 'originator_id') {

                        $originator = User::where("id", "=", $value)->first();
                        $new_message->originator = $originator;

                    }
                    if ($key === "created_at") {

                        $new_message->$key = date('m/d/y H:i:s a', strtotime($value));

                    } else if ($key === 'phone') {

                        $new_message->$key = format_field($key, $value);

                    } else if ($key === 'acknowledged') {

                        $new_message->$key = (!! $value);

                    } else {
                        $new_message->$key = $value;
                    }
                }
                $new_messages[] = $new_message;
            }

            // dd($new_messages);
            $json_messages = json_encode($new_messages, true);
            // dd(["new_messages" => $new_messages]);
            return view('messages.index', ['messages' => $new_messages, "messages_original" => $messages] );

        }
        // if not an agent then just redirect back
        return redirect()->back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->getUsers();
        // dd($users);
        $groups = AffiliateGroup::where("affiliate_id", '=', 1)->get();
        $usersString = json_encode($users);
        // dd($usersString);
        return view('messages.new-message', ["usersString" => $usersString, "users" => $users, "groups" => $groups]);
    }

    private function getUsers()
    {
        $agents = User::where('affiliate_id', '=', 1)->get();

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

    public function show(MessageUser $messageUser)
    {
        if (! auth()->user()->id === $messageUser->user_id) {
            return view('messages.message', ['message' => []] );
        }

        $new_message = new \stdClass();
        $originator = User::where("id", "=", $messageUser->originator_id)->first();;
        $new_message->originator = $originator;
        $new_message->id = $messageUser->id;
        $new_message->subject = $messageUser->subject;
        $new_message->acknowledged = (!! $messageUser->acknowledged);
        $new_message->created_at = date('m/d/y H:i:s a', strtotime($messageUser->created_at));

        $email = new \App\Mail\NewQuoteReceivedMail($messageUser);
        $email_message = (string) $email->render();
        $new_message->email = MailBodyBuilder::build( $email_message );

        return view('messages.message', ['message' => $new_message] );
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageUser $userMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageUser $userMessage)
    {
        //
    }

    /**
     * @param \App\Models\MessageUser $messageUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function acknowledge(MessageUser $messageUser)
    {
        $user = Auth::user();
        // make sure we have an agent and that the message belongs to that agent.
        if ($user->is_agent() && $messageUser->user_id === $user->id) {

            $messageUser->acknowledged = 1;
            $messageUser->save();

            $originator = User::find($messageUser->originator_id);

            $notification = new \App\Notifications\MessageAcknowledgedNotification([$originator], "Message Acknowledgement", auth()->user()->name." acknowledged Message", function (
                $id,
                $notification,
                $canNotify
            ) {
                // dd([$id, $notification, $canNotify]);
            }, \App\Events\ExampleEvent::class);

            Notification::send($originator, $notification);
        }

        return redirect()->back();
    }

    public function destroy(MessageUser $messageUser)
    {
        $messageUser->delete();
        return redirect()->route('messages');
    }
}
