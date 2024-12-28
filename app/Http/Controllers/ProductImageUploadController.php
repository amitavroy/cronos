<?php

namespace App\Http\Controllers;

use App\Domain\Product\Models\Product;
use Illuminate\Http\Request;

class ProductImageUploadController extends Controller
{
    public function __invoke(Product $product, Request $request)
    {
        $request->validate([
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('featured_image')->store('product/featured_images');

        $product->featured_image = $path;
        $product->save();

        return redirect()->route('product.show', $product);
    }
}
