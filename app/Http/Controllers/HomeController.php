<?php

namespace App\Http\Controllers;

use App\Actions\HomePageData;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    public function __invoke(HomePageData $homePageData): Response|ResponseFactory
    {
        $data = $homePageData->handle();

        return inertia('Home', [
            'order_count' => $data['order_count'],
            'product_count' => $data['product_count'],
            'customer_count' => $data['customer_count'],
        ]);
    }
}
