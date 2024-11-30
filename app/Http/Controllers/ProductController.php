<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')
            ->paginate();

        return inertia('Product/Index')
            ->with('products', $products);
    }
}
