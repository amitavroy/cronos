<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')
            ->paginate();

        return inertia('Product/Index')
            ->with('products', $products);
    }

    public function store(Request $request)
    {
        $postData = $request->validate([
            'name' => 'required|min:3',
            'price' => 'numeric|min:1',
            'category' => 'required|min:2',
            'description' => 'required|min:3',
        ]);

        Product::create($postData);

        return to_route('product.index');
    }

    public function create()
    {
        return inertia('Product/Create');
    }

    public function show(Product $product)
    {
        return inertia('Product/Show', ['product' => $product]);
    }
}
