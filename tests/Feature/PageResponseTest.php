<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Testing all page response', function () {

    it('loads the login page', function () {
        $this->withoutVite();
        get(route('login'))->assertOk();
    });

    it('loads the home page for auth user', function () {
        $this->withoutVite();
        actingAs(User::factory()->create());

        get(route('home'))->assertOk();
    });

    it('loads the product listing page for auth user', function () {
        $this->withoutVite();
        actingAs(User::factory()->create());

        get(route('product.index'))->assertOk();
    });

    it('loads the product details page for auth user', function () {
        $this->withoutVite();
        actingAs(User::factory()->create());
        $product = Product::factory()->create();

        get(route('product.show', ['product' => $product]))->assertOk();
    });

    it('loads the user listing page for auth user', function () {
        $this->withoutVite();
        actingAs(User::factory()->create());

        get(route('user.index'))->assertOk();
    });

    it('loads the user details page for auth user', function () {
        $this->withoutVite();
        $user = User::factory()->create();

        actingAs($user);

        get(route('user.show', ['user' => $user]))->assertOk();
    });

    it('loads the user add page for auth user', function () {
        $this->withoutVite();
        $user = User::factory()->create();

        actingAs($user);

        get(route('user.create'))->assertOk();
    });

    it('loads the profile page', function () {
        $this->withoutVite();
        $user = User::factory()->create();

        actingAs($user);

        get(route('user-profile.show'))->assertOk();
    });

    it('loads the orders page', function () {
        $this->withoutVite();
        $user = User::factory()->create();

        actingAs($user);

        get(route('order.index'))->assertOk();
    });

    it('loads the customers page', function () {
        $this->withoutVite();
        $user = User::factory()->create();

        actingAs($user);

        get(route('customer.index'))->assertOk();
    });
});
