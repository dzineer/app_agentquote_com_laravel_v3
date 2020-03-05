<?php

namespace App\Http\Controllers\Api;

use App\Notifications\NewMessageNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MessageUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class MessagesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ( $user->not_agent() ) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized Request."
            ]);
        }

        $data = $this->validate($request, [
            "group_id" => 'required',
            "user_id" => 'required',
            "subject" => 'required',
            "message" => 'required',
        ]);

        $message =  MessageUser::create([
            "message_type_id" => 1,
            "originator_id" => auth()->user()->id,
            "user_id" =>  $data['user_id'],
            "subject" => $data['subject'],
            "body" => $data['message'],
            "acknowledged" => 0,
        ]);

        $to = User::find($data['user_id']);

        $notification = new NewMessageNotification([$to], "New Message", "You have received a new message", function($id, $notification, $canNotify) {
            // dd([$id, $notification, $canNotify]);
        }, \App\Events\ExampleEvent::class);

        Notification::send($to, $notification);

        return response()->json([
            "success" => true,
            "message" => "Message received."
        ]);
    }

    public function acknowledge(MessageUser $messageUser)
    {
        $messageUser->acknowledged = 1;
        $messageUser->save();

        // dd($messageUser);
        return response()->json([
            "success" => false,
            "message" => $messageUser
        ]);

        $originator = User::find($messageUser->originator_id);

        $notification = new \App\Notifications\MessageAcknowledgedNotification([$originator], "Message Acknowledgement", auth()->user()->name . " acknowledged Message", function($id, $notification, $canNotify) {
            // dd([$id, $notification, $canNotify]);
        }, \App\Events\ExampleEvent::class);

        Notification::send($originator, $notification);

        return response()->json([
            "success" => true,
            "message" => "Message acknowledged."
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json([
            "success" => true,
            "message" => "All notifications marked as read."
        ]);
    }

}
