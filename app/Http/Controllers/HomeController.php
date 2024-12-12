<?php

namespace App\Http\Controllers;

use App\Actions\HomePageData;
use App\Services\CustomerService;
use App\Services\ProductService;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    public function __invoke(
        HomePageData $homePageData,
        CustomerService $customerService,
        ProductService $productService,
    ): Response|ResponseFactory {
        $data = $homePageData->handle();

        return inertia('Home/Index', [
            'order_count' => $data['order_count'],
            'product_count' => $data['product_count'],
            'customer_count' => $data['customer_count'],
            'top_customers' => $customerService->getTopCustomers(),
            'top_products' => $productService->getTopProducts(),
        ]);
    }
}
