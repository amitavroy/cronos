<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $products = Product::orderByDesc('id')
            ->paginate();

        return inertia('Product/Index', [
            'products' => $products,
        ]);
    }

    public function store(Request $request): RedirectResponse
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

    public function create(): Response|ResponseFactory
    {
        return inertia('Product/Create');
    }

    public function show(Product $product): Response|ResponseFactory
    {
        return inertia('Product/Show', ['product' => $product]);
    }

    public function update(Product $product, Request $request): RedirectResponse
    {
        $postData = $request->validate([
            'name' => 'required|min:3',
            'price' => 'numeric|min:1',
            'category' => 'required|min:2',
            'description' => 'required|min:3',
        ]);

        $product->update($postData);

        return to_route('product.show', ['product' => $product]);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->back();
    }
}
