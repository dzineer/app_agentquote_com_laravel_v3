<?php

namespace App\Listeners;

use App\Events\GroupAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogGroupAdded
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
     * @param  GroupAdded  $event
     * @return void
     */
    public function handle(GroupAdded $event)
    {
        //
    }
}
