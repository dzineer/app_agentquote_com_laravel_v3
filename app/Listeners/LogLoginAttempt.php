<?php

namespace App\Listeners;

use App\Events\LoginAttempt;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogLoginAttempt
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
     * @param  LoginAttempt  $event
     * @return void
     */
    public function handle(LoginAttempt $event)
    {
        //
    }
}
