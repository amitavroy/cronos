<?php

use App\Models\Order;
use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;

uses(RefreshDatabase::class);

describe('Customer service tests to get active customers', function () {
    it('gives a paginated data', function () {
        $customer = User::factory()->customer()->create();

        $list = app(CustomerService::class)->getActiveCustomers();

        expect($list)->toBeInstanceOf(LengthAwarePaginator::class);
    });

    it('gives only customers', function () {
        $customer = User::factory()->customer()->create();
        User::factory()->admin()->create();

        $list = app(CustomerService::class)->getActiveCustomers();

        expect($list)
            ->and($list->count())
            ->toBe(1)
            ->and($list->first()->name)->toEqual($customer->name);
    });

    it('sorts by name', function () {
        $zord = User::factory()->customer()->create(['name' => 'Zord']);
        $clark = User::factory()->customer()->create(['name' => 'Clark']);

        $list = app(CustomerService::class)->getActiveCustomers();

        expect($list->first()->name)
            ->toBe($clark->name)
            ->and($list->last()->name)
            ->toEqual($zord->name);
    });
});

describe('Customer service test to get top customers', function () {
    it('gives top customers', function () {
        $user1 = User::factory()->customer()->create();
        Order::factory(2)->completed()->create(['user_id' => $user1->id]);

        $user2 = User::factory()->customer()->create();
        Order::factory(4)->completed()->create(['user_id' => $user2->id]);

        $customers = app(CustomerService::class)->getTopCustomers();

        expect($customers)
            ->toBeInstanceOf(Collection::class)
            ->and($customers->first()->name)->toBe($user2->name)
            ->and($customers->count())->toEqual(2);
    });

    it('only gives customers', function () {
        $user1 = User::factory()->customer()->create();
        $user2 = User::factory()->admin()->create();

        $customers = app(CustomerService::class)->getTopCustomers();

        expect($customers->count())->toEqual(1);
    });
});
