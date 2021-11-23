<?php

namespace App\Http\Controllers;

use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class profileController extends Controller
{

    public function __construct() 
    {
        $this->middleware(['auth:api']);
    }


    public function index() 
    {
        return response()->json(
            new userResource(auth()->user())
        );
    }

    public function me() 
    {
        return response()->json(
            new userResource(auth()->user()) 
        );
    }

    public function update(Request $request) 
    {
        
        $this->validate_request($request);

        $updates = [
            'name'      => $request->name,
            'email'     => $request->email,
            'username' => $request->username
        ];

        if($request->has('avatar')) 
        {
            $updates['avatar']= $this->deleteOldImageAndUpdate(auth()->user());
        }

        $user = tap($request->user())->update($updates);    
        
        return response()->json([
            'data'     => new userResource($user),
            'message'  => 'Profile updated'
        ], 200);

    }

    public function deleteOldImageAndUpdate(User $user)
    {
        $image = $user->avatar;
        Storage::delete('public/' . $image);
        return request()->file('avatar')->store('images/users', 'public');
    }

    public function validate_request(Request $request) 
    {
        return $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$request->user()->id,
            'username'  => 'required|regex:/^\S*$/u|unique:users,username,'.$request->user()->id.'|string|between:4,20',
            'avatar'    => 'sometimes|image|dimensions:min_width=256,min_height:256|nullable',
        ]);    
    }
}
