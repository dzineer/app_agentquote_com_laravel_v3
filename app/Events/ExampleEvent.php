<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ExampleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $notification;
    private $can_notify;

    /**
     * Create a new event instance.
     *
     * @param $notificationInfo
     */
    public function __construct($notificationInfo)
    {
        $notification = \DB::table('notifications')
            ->where('notifications.id', "=", $notificationInfo->id)
            ->first();
        // dd($notification);
        $user = User::find($notification->notifiable_id);
        // dd($user);
        if ($user->notification_permission) {
            $this->can_notify = !! $user->notification_permission->notifications_enabled;
        } else {
            $this->can_notify = false;
        }

        // dd($user);

        // dd($notification);

        $this->notification = ["notification" => $notification];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     */
    public function broadcastOn()
    {
        if ( $this->can_notify ) {
            return new Channel('test-event');
        }
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->notification
        ];
    }
}
