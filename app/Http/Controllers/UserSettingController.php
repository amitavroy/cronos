<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserSettingController extends Controller
{
    public function show(): Response|ResponseFactory
    {
        $user = Auth::user();

        return inertia('UserSettings/Show', [
            'user' => $user,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'country' => 'required',
        ]);

        User::where('id', $request->user()?->id)
            ->update([
                'name' => $request->input('name'),
                'position' => $request->input('position'),
                'country' => $request->input('country'),
            ]);

        return redirect()
            ->to(route('user-profile.show'))
            ->with('success', 'Profile updated');
    }
}
