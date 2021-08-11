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
        [
            // 'name' => $name, 
            // 'email' => $email,
            'token'    => $token,
            'username' => $username,
            'password' => $password
        ] = $this->validate_request($request); 

        $email = optional(DB::table('invite_tokens')->where('token', $token)->first())->email;

        User::create([
            'email'         => $email,
            'user_name'     => $username,
            'password'      => bcrypt($password),    
            'registered_at' => now(),
        ]);

        event(new send_pin_to_users($email));

        return response()->json('Your account has been created.');
    
    }

    public function validate_request(Request $request) 
    {
        return $request->validate([
            'token'     => 'required|exists:invite_tokens',
            'username'  => 'required|unique:users,user_name|string|between:4,20',
            'password'  => 'required|string|between:6,25',
        ]);    
    }



}
