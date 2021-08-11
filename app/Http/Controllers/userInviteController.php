<?php

namespace App\Http\Controllers;

use App\Events\send_invite_email_to_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class userInviteController extends Controller
{
    
    public function __construct() 
    {
        $this->middleware(['auth:api']);
    }

    public function invite(Request $request) 
    {

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email'
        ]);

        if(!Gate::allows('invite', $request->user())) 
        {
            return abort(401, 'You are Unauthorized');
        }

        
        event(new send_invite_email_to_user($request->email, $request->name));

        return "User invitation link sent";

    }

}
