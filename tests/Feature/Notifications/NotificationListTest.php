<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Notification listing test', function () {
   it('lists the notifications for admin user', function () {
       $admin = User::factory()->admin()->create();
       actingAs($admin);

       get(route('notification.index'))->assertOk();
    });

    it('redirects to dashboard for non-admin user', function () {
        $customer = User::factory()->customer()->create();
        $manager = User::factory()->manager()->create();

        actingAs($customer);
        get(route('notification.index'))->assertForbidden();

        actingAs($manager);
        get(route('notification.index'))->assertForbidden();
    });
})->only();
