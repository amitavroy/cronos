<?php

namespace App\Services;

use App\Enum\OrderStatus;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    /**
     * @return LengthAwarePaginator<Order>
     */
    public function getCompletedOrders(): LengthAwarePaginator
    {
        return Order::where('status', OrderStatus::COMPLETE->value)
            ->with('products', 'user:id,email,name,country')
            ->withCount('products')
            ->paginate(20);
    }
}
