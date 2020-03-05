<?php

namespace App\Listeners;

use App\Contracts\PendingUserContract;
use App\Contracts\UserContract;
use App\Events\PasswordUpdated;
use App\Mail\PasswordUpdatedNotification;
use App\Models\EventsUser;
use App\Models\EventType;
use App\Models\LoginsLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogPasswordUpdated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PasswordUpdated  $event
     * @return void
     */
    public function handle(PasswordUpdated $event)
    {
        $eventType = EventType::where('name', '=', 'password_changed')->first();

        LoginsLog::create([
            'affiliate_id' => $event->user->affiliate_id,
            'user_id' => $event->user->id,
            'event_id' => $eventType->id
        ]);

        EventsUser::create([
            'affiliate_id' => $event->user->affiliate_id,
            'user_id' => $event->user->id,
            'event_id' => $eventType->id
        ]);

        \Mail::to($event->user->email, $event->user->fname)->send(new PasswordUpdatedNotification(
            new UserContract($event->user->fname, $event->user->lname, $event->user->email, '')
        ));
    }
}
