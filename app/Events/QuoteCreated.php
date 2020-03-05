<?php

namespace App\Events;

use App\Blueprints\QuoteBluePrint;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class QuoteCreated implements ShouldBroadcast
{


    use Dispatchable, SerializesModels;

    /**
     * @var \App\Blueprints\QuoteBluePrint
     */
    public $quote;

    public $results;

    public $nResults;

    public $user;

    public $notification;

    /**
     * Create a new event instance.
     *
     * @param \App\Blueprints\QuoteBluePrint $quote
     * @param $user
     * @param $results
     * @param $nResults
     * @param $notification
     */
    public function __construct(QuoteBluePrint $quote, $user, $results, $nResults, $notification)
    {
        $this->quote = $quote;
        $this->results = $results;
        $this->nResults = $nResults;
        $this->user = $user;
        $this->notification = $notification;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return ['notification' => $this->notification];
    }

    /**
     * @return \Illuminate\Broadcasting\PrivateChannel
     */
    public function broadcastOn()
    {
       return new PrivateChannel('App.User.'.$this->user->id);
    }
}
