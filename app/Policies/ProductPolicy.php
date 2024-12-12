<?php

namespace App\Policies;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->role === UserRole::MANAGER->value;
    }

    public function update(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->role === UserRole::MANAGER->value;
    }

    public function delete(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->role === UserRole::MANAGER->value;
    }

    public function restore(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->role === UserRole::MANAGER->value;
    }

    public function forceDelete(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->role === UserRole::MANAGER->value;
    }
}
