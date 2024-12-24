<?php

use App\Domain\Product\Models\Product;
use App\Domain\Product\Services\ProductService;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('ProductService get top products', function () {
    it('gives a collection of products', function () {
        Product::factory(5)->create();

        $products = app(ProductService::class)->getTopProducts();

        expect($products)->toBeInstanceOf(Collection::class);
    });

    it('gives top results', function () {
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        Order::factory(2)->create()->each(function (Order $order) use ($product1) {
            $items = 3;
            for ($i = 0; $i < $items; $i++) {
                $order->products()->attach($product1->id, [
                    'quantity' => 1,
                    'unit_price' => $product1->price,
                    'subtotal' => $product1->price * $items,
                ]);
            }
        });

        Order::factory(2)->create()->each(function (Order $order) use ($product2) {
            $items = 2;
            for ($i = 0; $i < $items; $i++) {
                $order->products()->attach($product2->id, [
                    'quantity' => 1,
                    'unit_price' => $product2->price,
                    'subtotal' => $product2->price * $items,
                ]);
            }
        });

        $products = app(ProductService::class)->getTopProducts();

        expect($products)
            ->toBeInstanceOf(Collection::class)
            ->and($products->first()->id)->toBe($product1->id);
    });
});
