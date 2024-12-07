<?php

use App\Actions\CreateRandomOrder;
use App\Actions\HomePageData;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('HomePageData tests', function () {
    it('gives the correct order count', function () {
        User::factory(10)->create();

        app(CreateRandomOrder::class)->handle(10);

        $homePageData = app(HomePageData::class)->handle();

        expect($homePageData['order_count'])->toBe(10);
    });

    it('gives the correct customer count', function () {
        $randNo = rand(2, 9);

        User::factory($randNo)->customer()->create();

        $homePageData = app(HomePageData::class)->handle();

        expect($homePageData['customer_count'])->toBe($randNo);
    });

    it('gives the correct product count', function () {
        $randNo = rand(2, 9);

        Product::factory($randNo)->create();

        $homePageData = app(HomePageData::class)->handle();

        expect($homePageData['product_count'])->toBe($randNo);
    });
});
