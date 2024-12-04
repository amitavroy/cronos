<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Request;

class UserSettingController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return inertia('UserSettings/Show')
            ->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        //
    }
}
