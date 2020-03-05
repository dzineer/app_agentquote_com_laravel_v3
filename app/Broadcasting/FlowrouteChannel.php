<?php

namespace App\Broadcasting;

use App\User;
use Illuminate\Notifications\Notification;

class FlowrouteChannel implements BroadcastingChannel
{
    /**
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return mixed
     */
    public function send( $notifiable, Notification $notification ) {
        // TODO: Implement send() method.
        $notification->toSMS( $notifiable );
    }

    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        //
    }
}
