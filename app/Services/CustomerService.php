<?php

namespace App\Services;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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
            ->withSum('orders', 'total_amount')
            ->orderBy('name', 'asc')
            ->paginate(10);
    }

    /**
     * @return Collection<int, User>
     */
    public function getTopCustomers(): Collection
    {
        return User::query()
            ->where('role', UserRole::CUSTOMER->value)
            ->withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get();
    }
}
