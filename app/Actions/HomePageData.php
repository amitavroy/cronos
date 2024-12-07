<?php

namespace App\Actions;

use App\Enum\UserRole;
use App\Models\Product;
use App\Models\User;

class HomePageData
{
    public function handle(): array
    {
        return [
            'user_count' => User::count(),
            'customer_count' => User::where(['role' => UserRole::CUSTOMER->value])->count(),
            'product_count' => Product::count(),
        ];
    }
}
