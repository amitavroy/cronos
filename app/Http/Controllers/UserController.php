<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $users = User::orderByDesc('id')->paginate(10);

        return inertia('User/Index')
            ->with('users', $users);
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('User/Create');
    }

    public function store(Request $request)
    {
        $postData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'position' => 'required|min:3',
            'country' => 'required|min:3',
        ]);

        User::create($postData);

        return to_route('user.index');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
