<?php

use App\Domain\Product\Models\Product;
use App\Domain\Segment\Models\Segment;
use App\Models\Order;
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

    it('loads the product create page for auth user', function () {
        $this->withoutVite();
        actingAs(User::factory()->create());

        get(route('product.create'))->assertOk();
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

    it('loads the order details page', function () {
        $this->withoutVite();
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        actingAs($user);

        get(route('order.show', ['order' => $order]))->assertOk();
    });

    it('loads the customers page', function () {
        $this->withoutVite();
        $user = User::factory()->create();

        actingAs($user);

        get(route('customer.index'))->assertOk();
    });

    it('loads customer details page', function () {
        $this->withoutVite();
        $user = User::factory()->customer()->create();

        actingAs($user);

        get(route('customer.show', ['customer' => $user]))->assertOk();
    });

    it('loads the notification page', function () {
        $this->withoutVite();
        $user = User::factory()->admin()->create();

        actingAs($user);

        get(route('notification.index'))->assertOk();
    });

    it('loads the notification create page for admin user', function () {
        $this->withoutVite();
        $user = User::factory()->admin()->create();

        actingAs($user);

        get(route('notification.create'))->assertOk();
    });

    it('loads the segment listing page', function () {
        $this->withoutVite();
        $user = User::factory()->admin()->create();

        actingAs($user);

        get(route('segment.index'))->assertOk();
    });

    it('loads the segment view page', function () {
        $this->withoutVite();
        $user = User::factory()->admin()->create();
        $segment = Segment::factory()->create();

        actingAs($user);

        get(route('segment.show', ['segment' => $segment]))->assertOk();
    });

    it('loads the segment create page', function () {
        $this->withoutVite();
        $user = User::factory()->admin()->create();
        $segment = Segment::factory()->create();

        actingAs($user);

        get(route('segment.create', ['segment' => $segment]))->assertOk();
    });

    it('loads the segment edit page', function () {
        $this->withoutVite();
        $user = User::factory()->admin()->create();
        $segment = Segment::factory()->create();

        actingAs($user);

        get(route('segment.show', ['segment' => $segment]))->assertOk();
    });
});
