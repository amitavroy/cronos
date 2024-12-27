<?php

namespace App\Policies;

use App\Enum\UserRole;
use App\Models\User;
use App\Models\UserProfile;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function view(User $user, UserProfile $userProfile): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->id === $userProfile->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, UserProfile $userProfile): bool
    {
        return $user->id === $userProfile->user_id;
    }

    public function delete(User $user, UserProfile $userProfile): bool
    {
        return $user->id === $userProfile->user_id;
    }

    public function restore(User $user, UserProfile $userProfile): bool
    {
        return $user->id === $userProfile->user_id;
    }

    public function forceDelete(User $user, UserProfile $userProfile): bool
    {
        return $user->id === $userProfile->user_id;
    }
}
