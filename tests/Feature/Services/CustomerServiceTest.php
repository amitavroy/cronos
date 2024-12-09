<?php

use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;

uses(RefreshDatabase::class);

describe('Customer service tests', function () {
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
