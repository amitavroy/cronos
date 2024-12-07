<?php

namespace App\Http\Controllers;

use App\Actions\HomePageData;

class HomeController extends Controller
{
    public function __invoke(HomePageData $homePageData)
    {
        $data = $homePageData->handle();

        return inertia('Home')
            ->with('order_count', $data['order_count'])
            ->with('product_count', $data['product_count'])
            ->with('customer_count', $data['customer_count']);
    }
}
