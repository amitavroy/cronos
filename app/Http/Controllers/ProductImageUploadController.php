<?php

namespace App\Http\Controllers;

use App\Domain\Product\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageUploadController extends Controller
{
    public function store(Product $product, Request $request): RedirectResponse
    {
        $request->validate([
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('featured_image')->store('product/featured_images');

        $product->featured_image = $path;
        $product->save();

        return redirect()->route('product.show', $product);
    }

    public function destroy(Product $product): RedirectResponse
    {
        Storage::delete($product->featured_image);

        $product->featured_image = null;
        $product->save();

        return redirect()->route('product.show', $product);
    }
}
