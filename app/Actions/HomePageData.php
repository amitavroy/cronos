<?php

namespace App\Actions;

use App\Enum\OrderStatus;
use App\Enum\UserRole;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class HomePageData
{
    public function handle(): array
    {
        return [
            'order_count' => Order::where('status', OrderStatus::COMPLETE->value)->count(),
            'customer_count' => User::where(['role' => UserRole::CUSTOMER->value])->count(),
            'product_count' => Product::count(),
        ];
    }
}