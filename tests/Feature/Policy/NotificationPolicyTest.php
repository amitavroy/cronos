<?php

use App\Domain\Notification\Policies\NotificationPolicy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

describe('Test Notification policy', function () {
    it('allows viewing all by admin only', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new NotificationPolicy;

        expect($policy->viewAny($admin))->toBeTrue();
        expect($policy->viewAny($manager))->toBeFalse();
        expect($policy->viewAny($customer))->toBeFalse();
    });

    it('allows viewing admin only', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new NotificationPolicy;

        actingAs($admin);
        expect($policy->view($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->view($manager))->toBeTrue();

        actingAs($customer);
        expect($policy->view($customer))->toBeTrue();
    });

    it('allows creation by admin only', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new NotificationPolicy;

        actingAs($admin);
        expect($policy->create($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->create($manager))->toBeFalse();

        actingAs($customer);
        expect($policy->create($customer))->toBeFalse();
    });

    it('allows update by admin only', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new NotificationPolicy;

        actingAs($admin);
        expect($policy->update($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->update($manager))->toBeFalse();

        actingAs($customer);
        expect($policy->update($customer))->toBeFalse();
    });

    it('allows delete by admin only', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new NotificationPolicy;

        actingAs($admin);
        expect($policy->delete($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->delete($manager))->toBeFalse();

        actingAs($customer);
        expect($policy->delete($customer))->toBeFalse();
    });

    it('allows restore by admin only', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new NotificationPolicy;

        actingAs($admin);
        expect($policy->restore($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->restore($manager))->toBeFalse();

        actingAs($customer);
        expect($policy->restore($customer))->toBeFalse();
    });

    it('allows forceDelete by admin only', function () {
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $policy = new NotificationPolicy;

        actingAs($admin);
        expect($policy->forceDelete($admin))->toBeTrue();

        actingAs($manager);
        expect($policy->forceDelete($manager))->toBeFalse();

        actingAs($customer);
        expect($policy->forceDelete($customer))->toBeFalse();
    });
});
