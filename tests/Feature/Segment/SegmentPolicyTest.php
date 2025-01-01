<?php

use App\Domain\Segment\Policies\SegmentPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Segment policy test', function () {
    it('only admin can view any segments', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $policy = new SegmentPolicy;
        expect($policy->viewAny($admin))->toBeTrue()
            ->and($policy->viewAny($manager))->toBeFalse()
            ->and($policy->viewAny($customer))->toBeFalse();
    });

    it('only admin can view segments', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $policy = new SegmentPolicy;
        expect($policy->view($admin))->toBeTrue()
            ->and($policy->view($manager))->toBeFalse()
            ->and($policy->view($customer))->toBeFalse();
    });

    it('only admin can create segments', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $policy = new SegmentPolicy;
        expect($policy->create($admin))->toBeTrue()
            ->and($policy->create($manager))->toBeFalse()
            ->and($policy->create($customer))->toBeFalse();
    });

    it('only admin can update segments', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $policy = new SegmentPolicy;
        expect($policy->update($admin))->toBeTrue()
            ->and($policy->update($manager))->toBeFalse()
            ->and($policy->update($customer))->toBeFalse();
    });

    it('only admin can delete segments', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $policy = new SegmentPolicy;
        expect($policy->delete($admin))->toBeTrue()
            ->and($policy->delete($manager))->toBeFalse()
            ->and($policy->delete($customer))->toBeFalse();
    });

    it('only admin can restore segments', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $policy = new SegmentPolicy;
        expect($policy->restore($admin))->toBeTrue()
            ->and($policy->restore($manager))->toBeFalse()
            ->and($policy->restore($customer))->toBeFalse();
    });

    it('only admin can forceDelete segments', function () {
        $admin = \App\Models\User::factory()->admin()->create();
        $manager = \App\Models\User::factory()->manager()->create();
        $customer = \App\Models\User::factory()->customer()->create();

        $policy = new SegmentPolicy;
        expect($policy->forceDelete($admin))->toBeTrue()
            ->and($policy->forceDelete($manager))->toBeFalse()
            ->and($policy->forceDelete($customer))->toBeFalse();
    });
});
