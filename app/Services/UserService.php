<?php

namespace App\Services;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserService
{
    /**
     * @return Builder<User>
     */
    public function getBaseUserQueryForSegment(): Builder
    {
        return User::query()
            ->withSum('orders', 'total_amount')
            ->where('role', UserRole::CUSTOMER->value);
    }
}
