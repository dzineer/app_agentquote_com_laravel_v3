<?php

namespace App\Listeners;

use App\Events\MailSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogMailSent
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
     * @param  MailSent  $event
     * @return void
     */
    public function handle(MailSent $event)
    {
        //
    }
}
