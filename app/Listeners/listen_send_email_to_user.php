<?php

namespace App\Listeners;

use App\Models\invite;
use Illuminate\Support\Facades\Mail;
use App\Mail\send_invitation_to_users;
use App\Events\send_invite_email_to_user;

class listen_send_email_to_user
{

    public function handle(send_invite_email_to_user $event)
    {
        $this->save_token($event->email, $event->token);
        Mail::to($event->email)->send(new send_invitation_to_users($event->token, $event->name));
    }

    public function save_token($email, $token) 
    {
        invite::create([
            'email' => $email,
            'token' => $token
        ]);
    }


}
