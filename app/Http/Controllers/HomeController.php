<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $data = [
            'todo_count' => Todo::get()->count(),
        ];

        return inertia('Home', [
            'data' => $data,
        ]);
    }
}
