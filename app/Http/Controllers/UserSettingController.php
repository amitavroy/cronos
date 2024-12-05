<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserSettingController extends Controller
{
    public function show(): Response|ResponseFactory
    {
        $user = Auth::user();

        return inertia('UserSettings/Show')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $postData = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'country' => 'required',
        ]);

        User::where('id', $request->user()->id)
            ->update($postData);
    }
}
