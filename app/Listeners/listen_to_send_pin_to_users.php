<?php

namespace App\Listeners;

use App\Events\send_pin_to_users;
use App\Mail\send_pin_to_users as MailSend_pin_to_users;
use Illuminate\Support\Facades\Mail;

class listen_to_send_pin_to_users
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
     * @param  send_pin_to_users  $event
     * @return void
     */
    public function handle(send_pin_to_users $event)
    {
        Mail::to($event->email)->send(new MailSend_pin_to_users($event->email));
    }
}
