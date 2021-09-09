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
            'password'      => bcrypt($request->password),    
            'registered_at' => now(),
        ]);

        return response()->json('Your account has been created.');
    
    }

    public function validate_request(Request $request) 
    {
        return $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users|email',
            'password'  => 'required|string|between:6,25',
        ]);    
    }



}
