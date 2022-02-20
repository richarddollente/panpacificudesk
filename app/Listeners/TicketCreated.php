<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TicketCreated
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

    public function handle($event)
    {
        $admins = User::wherHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($admins, new NewTicketNotification($event->ticket));
    }
}
