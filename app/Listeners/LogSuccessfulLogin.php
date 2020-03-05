<?php

namespace App\Listeners;

use App\Models\EventsUser;
use App\Models\EventType;
use App\Models\LoginsLog;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
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
     * @param Login $event
     * @return void
     * @throws \Exception
     */
    public function handle(Login $event)
    {
        $event->user->last_login_at = $event->user->login_at ? $event->user->login_at : Carbon::now();
        $event->user->login_at = Carbon::now();
        $event->user->save();

        $eventType = EventType::where('name', '=', 'login')->first();

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
