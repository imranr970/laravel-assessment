<?php

namespace App\Http\Controllers;

use App\Events\send_invite_email_to_user;
use Illuminate\Http\Request;

class userInviteController extends Controller
{
    
    public function __construct() 
    {
        $this->middleware(['auth:api', 'isAdmin']);
    }

    public function invite(Request $request) 
    {

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:invites,email'
        ], [
            'email.unique' => 'Invite is already sent to this email.'
        ]);

        $this->invite_user($request);        

        return "User invitation link sent";

    }

    public function invite_user(Request $request) 
    {
        event(new send_invite_email_to_user($request->email, $request->name));
    }

}
