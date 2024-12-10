<?php

namespace App\Services;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerService
{
    /**
     * @return LengthAwarePaginator<User>
     */
    public function getActiveCustomers(): LengthAwarePaginator
    {
        return User::query()
            ->where('role', UserRole::CUSTOMER->value)
            ->orderBy('name', 'asc')
            ->paginate(10);
    }

    /**
     * @return Builder<User>
     */
    public function getTopCustomers(): Builder
    {
        return User::query()
            ->where('role', UserRole::CUSTOMER->value)
            ->withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit(5);
    }
}
