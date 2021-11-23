<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class accountConfirmationController extends Controller
{
    public function confirm(Request $request) 
    {
        $request->validate([
            'email' => 'exists:users|email',
            'pin'   => 'exists:users,email_token'
        ], [
            'pin.exists' => 'Invalid token'
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        $user->update([
            'email_verified_at' => now(),
            'email_token'       => null
        ]);

        return response()->json([
            'Account confirmation success'
        ], 200);

    }
}
