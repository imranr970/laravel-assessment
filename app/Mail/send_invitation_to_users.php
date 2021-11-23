<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class send_invitation_to_users extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $token, $name, $url;
    public function __construct($token, $name)
    {
        $this->token = $token;
        $this->name = $name;
        $this->url = url('/api/register?token='.$token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invitation to Create a Free Account')->markdown('Invitation-email');
    }
}
