<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;

class todoController extends Controller
{
    
    public function __construct() 
    {
        $this->middleware(['auth:api']);
    }

    public function index(Request $request) 
    {
        return todo::where('user_id', $request->user()->id)->paginate(6);
    }

    public function create(Request $request) 
    {
        $request->validate([
            'title' => 'required'
        ]);    

        todo::create([
            'title' => $request->title,
            'isCompleted' => false,
            'user_id' => $request->user()->id
        ]);

        return response()->json('Todo Created', 201);

    }

    public function update(Request $request, todo $todo) 
    {
        if(!$this->isOwner($todo)) return 401;
        $request->validate([
            'title' => 'required'
        ]);

        $todo->update([
            'title' => $request->title,
            'isCompleted' => $request->isCompleted
        ]);
    }

    public function delete(todo $todo) 
    {
        if(!$this->isOwner($todo)) return 401;
        $todo->delete();
        return response()->json('User deleted');
    }

    public function isOwner($todo) 
    {
        return request()->user()->id === $todo->user_id;
    }

}
