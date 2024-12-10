<?php

namespace App\Http\Controllers;

use App\Actions\HomePageData;
use App\Services\CustomerService;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    public function __invoke(
        HomePageData $homePageData,
        CustomerService $customerService
    ): Response|ResponseFactory {
        $data = $homePageData->handle();
        logger($customerService->getTopCustomers());

        return inertia('Home/Index', [
            'order_count' => $data['order_count'],
            'product_count' => $data['product_count'],
            'customer_count' => $data['customer_count'],
            'top_customers' => $customerService->getTopCustomers(),
        ]);
    }
}
