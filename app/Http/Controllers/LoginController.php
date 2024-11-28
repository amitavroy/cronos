<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class LoginController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Public/Login');
    }

    public function store(Request $request): RedirectResponse
    {
        $postData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
            'remember' => ['required'],
        ]);

        if (User::where(['email' => $postData['email']])->first()) {
            Auth::attempt(
                credentials: ['email' => $postData['email'], 'password' => $postData['password']],
                remember: $postData['remember']
            );

            return to_route('home');
        }

        return redirect()->back();
    }
}
