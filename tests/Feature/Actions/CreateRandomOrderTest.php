<?php

use App\Actions\CreateRandomOrder;
use App\Console\Commands\TestCreateOrderCommand;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Create random order test', function () {
    it('breaks if there are no users', function () {
        $action = app(CreateRandomOrder::class);

        expect(fn () => $action->handle(1))->toThrow(Exception::class);
    });

    it('creates order items as well', function () {
        User::factory()->customer()->create();
        Product::factory(5)->create();

        app(CreateRandomOrder::class)->handle(1);

        expect(OrderItem::count())->toBeGreaterThan(0);
    });

    it('creates random orders in db', function () {
        User::factory()->customer()->create();
        Product::factory(5)->create();

        $action = app(CreateRandomOrder::class);

        $command = app(TestCreateOrderCommand::class)->handle($action);

        expect(OrderItem::count())->toBeGreaterThan(0);
    });
});
