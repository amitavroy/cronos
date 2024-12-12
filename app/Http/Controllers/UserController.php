<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserController extends Controller
{
    /**
     * @var array|string[]
     */
    private array $baseRules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'position' => 'required',
        'country' => 'required|min:2',
    ];

    public function index(): Response|ResponseFactory
    {
        $users = User::orderByDesc('id')->paginate(10);

        return inertia('User/Index', [
            'users' => $users,
        ]);
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('User/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $postData = $request->validate($this->baseRules);

        User::create($postData);

        return to_route('user.index');
    }

    public function show(User $user): Response|ResponseFactory
    {
        return inertia('User/Show', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $rules = $this->baseRules;

        unset($rules['password']);
        unset($rules['email']);
        
        $postData = $request->validate($rules);

        User::where('id', $user->id)->update($postData);

        return to_route('user.show', ['user' => $user]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->back();
    }
}
