<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
}
