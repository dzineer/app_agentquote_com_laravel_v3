<?php

namespace App\Composers;

use App\Models\SuperAd;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GlobalUserNotifications
{
    protected $notificationsString;

    public function compose(View $view)
    {
        if (auth()->check()) {
            $subscription_found = \DB::table('push_subscriptions')
                ->where('user_id', '=', auth()->user()->id)->exists();
            $notifications = auth()->user()->notifications;
            $userNotifications = new \stdClass();
            $userNotifications->subscription_registered = $subscription_found;
            $userNotifications->notifications = $notifications;

            if (auth()->user()->notification_permission) {
                $userNotifications->can_notify = !! auth()->user()->notification_permission->notifications_enabled;
            } else {
                $userNotifications->can_notify = false;
            }

           // dd($userNotifications);

            if ($notifications->count()) {
                $notificationsString = json_encode($userNotifications);
                $view->with('userNotifications', $notificationsString);
            } else {
                $notifications = new \stdClass();
                $notifications->items = [];
                $userNotifications->notifications = $notifications;
                $notificationsString = json_encode($userNotifications);
                $view->with('userNotifications', $notificationsString);
            }
        }
    }
}