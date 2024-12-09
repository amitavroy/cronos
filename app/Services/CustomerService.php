<?php

namespace App\Services;

use App\Enum\UserRole;
use App\Models\User;
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
}
