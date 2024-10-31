<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $request->merge(['user_id' => 1]);

        Todo::create($request->validate([
            'description' => ['required', 'min:3', 'max:255'],
            'completion_date' => ['required', 'date'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]));

        return redirect()->back()->with('success', 'Todo created successfully');
    }
}
