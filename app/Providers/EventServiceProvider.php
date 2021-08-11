<?php

namespace App\Providers;

use App\Events\send_invite_email_to_user;
use App\Events\send_pin_to_users;
use App\Listeners\listen_send_email_to_user;
use App\Listeners\listen_to_send_pin_to_users;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        send_invite_email_to_user::class => [
            listen_send_email_to_user::class  
        ],
        send_pin_to_users::class => [
            listen_to_send_pin_to_users::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
