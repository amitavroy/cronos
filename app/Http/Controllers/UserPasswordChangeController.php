<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserPasswordChangeController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed|different:current_password',
            'current_password' => 'required',
        ]);

        $user = $request->user();

        $user->password = $request->input('password');
        $user->save();

        return to_route('user-profile.show');
    }
}
