<?php

use App\Domain\Product\Policies\ProductPolicy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

describe('Product policy test', function () {
    it('allows anyone to view any', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new ProductPolicy;

        actingAs($admin);
        expect($policy->viewAny($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->viewAny($manager))->toBeTrue();

        actingAs($customer);
        expect($policy->viewAny($customer))->toBeTrue();
    });

    it('allows anyone to view', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new ProductPolicy;

        actingAs($admin);
        expect($policy->view())->toBeTrue();

        actingAs($manager);
        expect($policy->view())->toBeTrue();

        actingAs($customer);
        expect($policy->view())->toBeTrue();
    });

    it('allow admin and manager to create product', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new ProductPolicy;

        actingAs($admin);
        expect($policy->create($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->create($manager))->toBeTrue();

        actingAs($customer);
        expect($policy->create($customer))->toBeFalse();
    });

    it('allow admin and manager to update product', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new ProductPolicy;

        actingAs($admin);
        expect($policy->update($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->update($manager))->toBeTrue();

        actingAs($customer);
        expect($policy->update($customer))->toBeFalse();
    });

    it('allow admin and manage to delete product', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new ProductPolicy;

        actingAs($admin);
        expect($policy->delete($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->delete($manager))->toBeTrue();

        actingAs($customer);
        expect($policy->delete($customer))->toBeFalse();
    });

    it('allow admin and manage to restore product', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new ProductPolicy;

        actingAs($admin);
        expect($policy->restore($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->restore($manager))->toBeTrue();

        actingAs($customer);
        expect($policy->restore($customer))->toBeFalse();
    });

    it('allow admin and manage to force delete product', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new ProductPolicy;

        actingAs($admin);
        expect($policy->forceDelete($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->forceDelete($manager))->toBeTrue();

        actingAs($customer);
        expect($policy->forceDelete($customer))->toBeFalse();
    });
});
