<?php

use App\Models\UserProfile;
use App\Policies\UserProfilePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

describe('User profile policy', function () {
    it('allows only admin to view any profile', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $policy = new UserProfilePolicy;

        expect($policy->viewAny($admin))->toBe(true);
        expect($policy->viewAny($manager))->toBe(false);
        expect($policy->viewAny($customer))->toBe(false);
    });

    it('allows only admin and user to view profile', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $user_profile = UserProfile::factory()->create(['user_id' => $customer->id]);

        $policy = new UserProfilePolicy;

        expect($policy->view($admin, $user_profile))->toBe(true);
        expect($policy->view($manager, $user_profile))->toBe(false);
        expect($policy->view($customer, $user_profile))->toBe(true);
    });

    it('allows logged in user to create profile', function () {
        $customer = \App\Models\User::factory()->customer()->create();

        actingAs($customer);

        $policy = new UserProfilePolicy;

        expect($policy->create($customer))->toBe(true);
    });

    it('allows only owner to edit profile', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $user_profile = UserProfile::factory()->create(['user_id' => $customer->id]);

        $policy = new UserProfilePolicy;

        expect($policy->update($admin, $user_profile))->toBe(false);
        expect($policy->update($manager, $user_profile))->toBe(false);
        expect($policy->update($customer, $user_profile))->toBe(true);
    });

    it('allows only owner to delete profile', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $user_profile = UserProfile::factory()->create(['user_id' => $customer->id]);

        $policy = new UserProfilePolicy;

        expect($policy->delete($admin, $user_profile))->toBe(false);
        expect($policy->delete($manager, $user_profile))->toBe(false);
        expect($policy->delete($customer, $user_profile))->toBe(true);
    });

    it('allows only owner to restore profile', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $user_profile = UserProfile::factory()->create(['user_id' => $customer->id]);

        $policy = new UserProfilePolicy;

        expect($policy->restore($admin, $user_profile))->toBe(false);
        expect($policy->restore($manager, $user_profile))->toBe(false);
        expect($policy->restore($customer, $user_profile))->toBe(true);
    });

    it('allows only owner to force delete profile', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $user_profile = UserProfile::factory()->create(['user_id' => $customer->id]);

        $policy = new UserProfilePolicy;

        expect($policy->forceDelete($admin, $user_profile))->toBe(false);
        expect($policy->forceDelete($manager, $user_profile))->toBe(false);
        expect($policy->forceDelete($customer, $user_profile))->toBe(true);
    });
});
