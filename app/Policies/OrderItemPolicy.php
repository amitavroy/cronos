<?php

namespace App\Policies;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, OrderItem $orderItem): bool {}

    public function create(User $user): bool {}

    public function update(User $user, OrderItem $orderItem): bool {}

    public function delete(User $user, OrderItem $orderItem): bool {}

    public function restore(User $user, OrderItem $orderItem): bool {}

    public function forceDelete(User $user, OrderItem $orderItem): bool {}
}
