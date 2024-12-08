<?php

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;

uses(RefreshDatabase::class);

describe('OrderService tests', function () {
    it('gives a paginated data', function () {
        Order::factory(10)->completed()->create();

        $orders = app(OrderService::class)->getCompletedOrders();

        expect($orders)->toBeInstanceOf(LengthAwarePaginator::class);
    });

    it('gives only completed orders', function () {
        $completedOrder = Order::factory()->completed()->create();
        $pendingOrder = Order::factory()->pending()->create();

        $orders = app(OrderService::class)->getCompletedOrders();

        expect($orders)
            ->and($orders->count())->toBe(1)
            ->and($orders->first()->id)->toBe($completedOrder->id)
            ->and($orders->first())->not($pendingOrder->id);
    });

    it('has user details', function () {
        Order::factory()->completed()->create();

        $orders = app(OrderService::class)->getCompletedOrders();

        expect($orders->first())->toHaveKeys([
            'user.id',
            'user.email',
            'user.name',
        ]);
    });

    it('has product details', function () {
        Order::factory()->completed()->create();

        $orders = app(OrderService::class)->getCompletedOrders();

        expect($orders->first())->toHaveKey('products');
    });

    it('has product count', function () {
        Order::factory()->completed()->create();

        $orders = app(OrderService::class)->getCompletedOrders();

        expect($orders->first())
            ->toHaveKey('products_count');
    });
});
