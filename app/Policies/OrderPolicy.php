<?php

namespace App\Policies;

use App\Enum\UserRole;
use App\Models\Order;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::MANAGER->value || $user->role === UserRole::ADMIN->value;
    }

    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->user_id || $user->role === UserRole::ADMIN->value;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->id === $order->user_id;
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->id === $order->user_id;
    }

    public function restore(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value || $user->id === $order->user_id;
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }
}
