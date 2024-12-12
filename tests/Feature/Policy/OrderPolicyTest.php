<?php

use App\Models\Order;
use App\Models\User;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

describe('Test Order policy', function () {
    it('allows viewing admin and manager', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();

        $policy = new OrderPolicy();

        expect($policy->viewAny($admin))->toBeTrue()
            ->and($policy->viewAny($manager))->toBeTrue();
    });

    it('denies for customer', function () {
        $customer = User::factory()->customer()->create();

        $policy = new OrderPolicy();

        expect($policy->viewAny($customer))->toBeFalse();
    });

    it('allows view to owner and admin', function () {
        $admin = User::factory()->admin()->create();
        $customer = User::factory()->customer()->create();
        $order = Order::factory()->create(['user_id' => $customer->id]);

        $policy = new OrderPolicy();

        expect($policy->view($admin, $order))->toBeTrue()
            ->and($policy->view($customer, $order))->toBeTrue();
    });

    it('allows all users to create order', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new OrderPolicy();

        actingAs($admin);
        expect($policy->create())->toBeTrue();

        actingAs($manager);
        expect($policy->create())->toBeTrue();

        actingAs($customer);
        expect($policy->create())->toBeTrue();
    });

    it('allows only admin and customer to edit order', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new OrderPolicy();
        $order = Order::factory()->create(['user_id' => $customer->id]);

        actingAs($admin);
        expect($policy->update($admin, $order))->toBeTrue();

        actingAs($customer);
        expect($policy->update($customer, $order))->toBeTrue();

        actingAs($manager);
        expect($policy->update($manager, $order))->toBeFalse();
    });

    it('allows only admin and owner to delete orders', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new OrderPolicy();
        $order = Order::factory()->create(['user_id' => $customer->id]);

        actingAs($admin);
        expect($policy->delete($admin, $order))->toBeTrue();

        actingAs($customer);
        expect($policy->delete($customer, $order))->toBeTrue();

        actingAs($manager);
        expect($policy->delete($manager, $order))->toBeFalse();
    });

    it('allows only admin to restore', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new OrderPolicy();
        $order = Order::factory()->create(['user_id' => $customer->id]);

        actingAs($admin);
        expect($policy->restore($admin, $order))->toBeTrue();

        actingAs($manager);
        expect($policy->restore($manager, $order))->toBeFalse();

        actingAs($customer);
        expect($policy->restore($customer, $order))->toBeFalse();
    });

    it('allows only admin to force delete', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new OrderPolicy();

        actingAs($admin);
        expect($policy->forceDelete($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->forceDelete($manager))->toBeFalse();

        actingAs($customer);
        expect($policy->forceDelete($customer))->toBeFalse();
    });
});
