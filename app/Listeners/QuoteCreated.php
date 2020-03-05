<?php

namespace App\Listeners;

use App\Events\NewQuoteGenerated;
use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuoteCreated
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
     * @param \App\Events\NewQuoteGenerated $event
     * @return void
     */
    public function handle(NewQuoteGenerated $event)
    {
        //
    }
}
