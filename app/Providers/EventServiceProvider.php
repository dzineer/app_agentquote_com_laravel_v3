<?php

namespace App\Providers;

use App\Events\PasswordResetRequest;
use App\Events\PasswordUpdated;
use App\Events\QuoteCreated;
use App\Listeners\LogPasswordResetRequested;
use App\Listeners\LogPasswordUpdated;
use App\Listeners\LogQuoteCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfulLogin',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogSuccessfulLogout',
        ],

        PasswordResetRequest::class => [
            LogPasswordResetRequested::class
        ],

        PasswordUpdated::class => [
            LogPasswordUpdated::class
        ],

        QuoteCreated::class => [
            LogQuoteCreated::class
        ],

        'App\Events\Registration\UserRegistered' => [
            'App\Listeners\Registration\RegisterNewUser'
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
