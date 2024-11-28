<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Auth::logout();

        return to_route('login');
    }
}
