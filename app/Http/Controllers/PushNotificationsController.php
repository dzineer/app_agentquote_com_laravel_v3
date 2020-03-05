<?php

namespace App\Http\Controllers;

use App\Actions\AgentSignupAction;
use App\Actions\NewQuoteAction;
use App\Models\NotificationsUser;
use App\Notifications\AgentSignupNotification;
use App\Notifications\NewQuoteGeneratedNotification;
use App\Notifications\PushDemo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PushNotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        // Auth::loginUsingId(5);
        $user = Auth::user();
        $user_id = $user->id;
        $public_key = env('VAPID_PUBLIC_KEY');

       // $notifications = \App\Notification::where('notifiable_id', '=', $user->id)->get();
/*        return response()->json([
            "notifications" => $notifications,
            "user" => $user
        ]);*/

        return view('notifications.register-notifications', compact('user', 'user_id', 'public_key'));
    }

    public function store(Request $request) {
        $data = $this->validate($request, [
           'endpoint' => 'required',
           'keys.auth' => 'required',
           'keys.p256dh' => 'required',
        ]);

        $endpoint = $request->input('endpoint');
        $token = $request->input('keys.auth');
        $key =   $request->input('keys.p256dh');
        $user = Auth::user();

        $user->updatePushSubscription($endpoint, $key, $token);

        NotificationsUser::updateOrCreate(
            [
                "user_id" => $user->id
            ],
            [
                "user_id" => $user->id,
                "notifications_enabled" => 1
            ]);

        return response()->json([
            'success' => true
        ], 200);
      //  $user->update
    }

    public function push(Request $request) {
        $user = Auth::user();
        /*
                  ->title("New Signup")
            ->icon('/images/aq-notifications-icon.png')
            ->body('New Agent Signed Up!')
            ->action('View Agents', 'notification_action')
            ->data(['id' => $notification->id]);
         */

/*        Notification::send(Auth::user(), new AgentSingupNotification(
            "New Signup",
            "New Agent Signed Up!",
            "/images/aq-notifications-icon.png"
        ));*/

/*        Notification::send(Auth::user(), new NewQuoteGeneratedNotification(
            "New Quote",
            "New quote added",
            "/images/aq-notifications-icon.png"
        ));*/

        Auth::user()->notify(
            new NewQuoteGeneratedNotification(
                "New Quote",
                "New quote added",
                "/images/aq-notifications-icon.png"
            )
        );

        $notifications = json_encode($user->notifications);

        return response()->json([
            "success" => true,
            "notifications" => $notifications,
            "message" => "Notification submitted successfully."
        ]);

        //$this->sendNewQuoteNotification();
        return redirect()->back();
    }

    private function sendNewAgentNotification(): void
    {
        $action = new AgentSignupAction('New Agent Action', 'notification_action');
        $notification = new NewQuoteGeneratedNotification('New Agent', 'You have a new agent signup.', '/notification-icon', $action);
        Notification::send(User::all(), $notification);
    }

    private function sendNewQuoteNotification(): void
    {
        $action = new NewQuoteAction('New Quote Action', 'notification_action');
        $notification = new NewQuoteGeneratedNotification('New Quote', 'You have received a new quote.', '/notification-icon', $action);
        Notification::send(User::all(), $notification);
    }
}
