<?php

namespace App\Listeners;

use App\Events\PasswordResetRequest;
use App\Models\EventsUser;
use App\Models\EventType;
use App\Models\LoginsLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogPasswordResetRequested
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
     * @param  PasswordResetRequest  $event
     * @return void
     */
    public function handle(PasswordResetRequest $event)
    {
        $eventType = EventType::where('name', '=', 'user_password_reset_request')->first();

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
    }
}
