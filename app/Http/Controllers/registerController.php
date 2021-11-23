<?php

namespace App\Http\Controllers;

use App\Events\send_pin_to_users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class registerController extends Controller
{
    
    public function __construct() 
    {
        $this->middleware(['guest']);
    }

    public function register(Request $request) 
    {
        $this->validate_request($request); 
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'username'      => $request->username,
            'password'      => bcrypt($request->password),    
            'registered_at' => now()
        ]);

        $this->send_verification_token($request);

        return response()->json('Your account has been created. Check your email for account verification link.');
    
    }

    public function send_verification_token(Request $request) 
    {
        event(new send_pin_to_users($request->email));
    }

    public function validate_request(Request $request) 
    {
        return $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users|email|exists:invites,email',
            'username'  => 'required|unique:users,username',
            'password'  => 'required|string|between:6,25',
            'token'     => 'required|exists:invites,token'    
        ], [
            'email.exists' => 'You are not eligble for creating a free account!',
            'token.exists' => 'Invalid Invite token!'
        ]);    
    }



}
