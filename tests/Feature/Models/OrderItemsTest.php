<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Order item model test', function () {
    it('belongs to order', function () {
        $order = Order::factory()->create();

        $orderItem = OrderItem::factory()->create([
            'order_id' => $order->id,
        ]);

        expect($orderItem->order())
            ->toBeInstanceOf(BelongsTo::class)
            ->and($orderItem->order)
            ->toBeInstanceOf(Order::class);
    });

    it('it belongs to product', function () {
        $product = Product::factory()->create();

        $orderItem = OrderItem::factory()->create([
            'product_id' => $product->id,
        ]);

        expect($orderItem->product())
            ->toBeInstanceOf(BelongsTo::class)
            ->and($orderItem->product)
            ->toBeInstanceOf(Product::class);
    });
});
