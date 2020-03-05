<?php

namespace App\Listeners;

use App\Models\EventsUser;
use App\Models\EventType;
use App\Models\LoginsLog;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class LogSuccessfulLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
/*
        $eventType = EventType::where('name', '=', 'logout')->first();

        LoginsLog::create([
            'affiliate_id' => $event->user->affiliate_id,
            'user_id' => $event->user->id,
            'event_id' => $eventType->id
        ]);

       // dump($event->user);

        EventsUser::create([
            'affiliate_id' => $event->user->affiliate_id,
            'user_id' => $event->user->id,
            'event_id' => $eventType->id
        ]);
*/
    }
}
