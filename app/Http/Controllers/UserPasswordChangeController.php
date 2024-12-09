<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordChangeRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserPasswordChangeController extends Controller
{
    public function __invoke(UserPasswordChangeRequest $request): RedirectResponse
    {
        $password = type($request->password)->asString();

        User::where('id', $request->user()?->id)
            ->update([
                'password' => Hash::make($password),
            ]);

        return to_route('user-profile.show');
    }
}
