<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class accountConfirmationController extends Controller
{
    public function confirm(Request $request) 
    {
        $request->validate([
            'email' => 'exists:users|email|exists:invite_pins',
            'pin'   => ['string', 'size:6', 
                Rule::exists('invite_pins')->where('email', $request->email)
            ]
        ], [
            'pin.exists' => 'No email or Pin found for your account! Kindly double check.'
        ]);

        $user = User::where('email', $request->email)->first();
        $user = tap($user)->update([
            'email_verified_at' => now()
        ]);

        DB::table('invite_pins')->where('email', $request->email)->delete();

        return response()->json([
            'user' => $user,
            'Account confirmation success'
        ], 200);

    }
}
