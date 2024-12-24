<?php

namespace App\Http\Controllers;

use App\Actions\HomePageData;
use App\Domain\Product\Services\ProductService;
use App\Services\ChartDataService;
use App\Services\CustomerService;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    public function __invoke(
        HomePageData $homePageData,
        CustomerService $customerService,
        ProductService $productService,
        ChartDataService $chartDataService,
    ): Response|ResponseFactory {
        $data = $homePageData->handle();

        return inertia('Home/Index', [
            'order_count' => $data['order_count'],
            'product_count' => $data['product_count'],
            'customer_count' => $data['customer_count'],
            'top_customers' => $customerService->getTopCustomers(),
            'top_products' => $productService->getTopProducts(),
            'random_number' => random_int(1, 100),
            'recent_customer_count' => $chartDataService->getRecentCustomerCount(),
            'recent_order_count' => $chartDataService->getRecentOrderCount(),
        ]);
    }
}
