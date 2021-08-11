<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\send_invite_email_to_user;
use App\Mail\send_invitation_to_users;
use Illuminate\Support\Facades\DB;

class listen_send_email_to_user
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
     * @param  send_invite_email_to_user  $event
     * @return void
     */
    public function handle(send_invite_email_to_user $event)
    {
        $this->save_token($event->email, $event->token);
        Mail::to($event->email)->send(new send_invitation_to_users($event->token, $event->name));
    }

    public function save_token($email, $token) 
    {
        DB::table('invite_tokens')->insert([
            'email' => $email,
            'token' => $token
        ]);  
    }


}
