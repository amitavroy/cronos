<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    /**
     * @return Collection<int, Product>
     */
    public function getTopProducts(): Collection
    {
        return Product::query()
            ->withCount('orders')
            ->orderByDesc('orders_count')
            ->take(5)
            ->get();
    }
}
