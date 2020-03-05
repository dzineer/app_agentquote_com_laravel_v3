<?php

namespace App\Listeners;

use App\Events\GroupDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogGroupDeleted
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
     * @param  GroupDeleted  $event
     * @return void
     */
    public function handle(GroupDeleted $event)
    {
        //
    }
}
