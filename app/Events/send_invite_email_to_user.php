<?php

namespace App\Events;

use Illuminate\Support\Str;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class send_invite_email_to_user
{
    use Dispatchable, SerializesModels;

    public $token; 
    public $email;
    public $name;
    public function __construct($email, $name)
    {
        $this->token = substr(md5(rand(0, 9) . $email . time()), 0, 32);
        $this->email = $email;
        $this->name = $name;
    }
}
