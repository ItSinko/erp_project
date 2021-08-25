<?php

namespace App\Listeners;

use App\Events\SimpleNotifEvent;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SimpleNotiflistener
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
     * @param  SimpleNotifEvent  $event
     * @return void
     */
    public function handle(SimpleNotifEvent $event)
    {
        notify()->success('Laravel Notify is awesome!');

        return Redirect::home();
    }
}
