<?php

namespace App\Events;

use Illuminate\Support\Str;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class send_invite_email_to_user
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $token; 
    public $email;
    public $name;
    public function __construct($email, $name)
    {
        $this->token = Str::random(64);
        $this->email = $email;
        $this->name = $name;
    }
}
