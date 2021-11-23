<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;

class send_pin_to_users extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email, $url, $pin;
    public function __construct($email)
    {
        $this->email = $email;
        $this->pin = Str::random(6);
        $this->url = url('/api/confirm-account?email='.$this->email.'&token='.$this->pin);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->save_pin();
        return $this->subject('Your 6 digit Pin')->markdown('send-pin-to-users');
    }

    public function save_pin() 
    {
        User::where('email', $this->email)->update([
            'email_token' => $this->pin
        ]);
    }
}
