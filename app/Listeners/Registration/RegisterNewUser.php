<?php

namespace App\Listeners\Registration;

use App\Events\Registration\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterNewUser
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
     * @param \App\Events\Registration\UserRegistered $event
     *
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        //
    }
}
