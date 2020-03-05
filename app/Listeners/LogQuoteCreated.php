<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use App\Models\CarriersQuote;
use App\Models\QuoteUsers;
use App\Notifications\NewQuoteGeneratedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class LogQuoteCreated
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
     * @param  QuoteCreated  $event
     * @return void
     */
    public function handle(QuoteCreated $event)
    {
        $topCarriers = [];

        for($i=0; $i < count($event->results); $i++) {
            $topCarriers[] = $event->results[$i]["CompanyFK"];
        }

        $serializedTopCarriers = serialize($topCarriers);
        //$deSerializedTopCarriers = unserialize($serializedTopCarriers);

        $userInfo = $event->quote->toArray();

        $quoteUser = QuoteUsers::create(
            $userInfo
        );

        CarriersQuote::create([
            'quote_id' => $quoteUser->id,
            'data' => $serializedTopCarriers
        ]);

/*        $event->user->notify(
            new NewQuoteGeneratedNotification(
                "New Quote",
                "New quote added"
            )
        );*/

    }
}
