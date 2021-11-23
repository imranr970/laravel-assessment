<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\userResource;

class loginController extends Controller
{

    public function __construct() 
    {
        $this->middleware(['auth:api'])->except(['login']);
    }
    
    public function login(Request $request)
    {
        $credentials = $this->validate_login($request);
        if(!$token = auth()->attempt($credentials)) 
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'meta' => $token,
            'user' =>  new userResource(auth()->user()) 
        ]);
    }

    public function validate_login(Request $request) 
    {
        return $request->validate([
            'email' => ['required', 'email',
                Rule::exists('users')->where(fn($query) => 
                    $query->whereNotNull('email_verified_at')
                )
            ],
            'password' => 'required'
        ], [
            'email.exists' => 'Account not found or is not activated!'
        ]);
    }

}
