<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Inertia\Response;
use Inertia\ResponseFactory;

class OrderController extends Controller
{
    public function index(OrderService $service): Response|ResponseFactory
    {
        $orders = $service->getCompletedOrders();

        return inertia('Order/Index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order): Response|ResponseFactory
    {
        $order->load(['user', 'products']);

        return inertia('Order/Show', [
            'order' => $order,
        ]);
    }
}
