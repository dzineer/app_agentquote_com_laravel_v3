<?php

namespace App\Listeners;

use App\Events\LoginFailed;
use App\Models\EventsUser;
use App\Models\EventType;
use App\Models\LoginsLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogLoginFailed
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
     * @param  LoginFailed  $event
     * @return void
     */
    public function handle(LoginFailed $event)
    {
        $eventType = EventType::where('name', '=', 'login_failed')->first();

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
