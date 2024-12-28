<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfilePicUploadController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (! $request->hasFile('profile_pic') && $request->file('profile_pic')->isValid()) {
            return redirect()->route('user-profile.show');
        }

        $path = $request->file('profile_pic')->store('profile_pictures');

        auth()->user()?->profile()->update([
            'profile_pic' => $path,
        ]);

        return redirect()->route('user-profile.show');
    }
}
