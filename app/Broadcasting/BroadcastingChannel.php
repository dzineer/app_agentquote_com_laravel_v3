<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;

interface BroadcastingChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return void
     */
    public function send($notifiable, Notification $notification);
}
