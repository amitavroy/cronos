<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return auth()->user();
    }

    public function view(User $user, Todo $todo): bool
    {
        return $todo->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return auth()->user();
    }

    public function update(User $user, Todo $todo): bool
    {
        return $todo->user_id === $user->id;
    }

    public function delete(User $user, Todo $todo): bool
    {
        return $todo->user_id === $user->id;
    }

    public function restore(User $user, Todo $todo): bool
    {
        return $todo->user_id === $user->id;
    }

    public function forceDelete(User $user, Todo $todo): bool
    {
        return $todo->user_id === $user->id;
    }
}
