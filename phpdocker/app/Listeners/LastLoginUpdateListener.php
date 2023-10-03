<?php

namespace App\Listeners;

use App\Events\DefineLoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LastLoginUpdateListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event instanceof DefineLoginEvent) {
            $event->user->last_login_at = now();
            $event->user->save();
        }
    }
}
