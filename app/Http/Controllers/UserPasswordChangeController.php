<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPasswordChangeController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed|different:old_password',
            'old_password' => 'required',
        ]);

        $user = $request->user();

        $user->password = bcrypt($request->input('password'));
        $user->save();
    }
}
