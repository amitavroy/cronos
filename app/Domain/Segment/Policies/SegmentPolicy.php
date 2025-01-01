<?php

namespace App\Domain\Segment\Policies;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SegmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function view(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function update(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function delete(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function restore(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function forceDelete(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }
}
