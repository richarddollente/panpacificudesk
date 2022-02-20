<?php

namespace App\Providers;

use App\Events\UserCreateTicket;
use App\Events\UserUpdateTicket;
use App\Listeners\TicketCreated;
use App\Listeners\TicketUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreateTicket::class => [
            TicketCreated::class,
        ],
        UserUpdateTicket::class => [
            TicketUpdated::class,
        ]


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
