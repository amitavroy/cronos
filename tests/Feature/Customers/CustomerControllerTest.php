<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Customer controller test', function () {
    it('loads the customers listing page', function () {
        $this->withoutVite();

        User::factory()->customer()->create();

        actingAs(User::factory()->admin()->create());

        get(route('customer.index'))->assertOk();
    });

    it('returns not found if user is not customer', function () {
        $this->withoutVite();

        $user = User::factory()->admin()->create();

        actingAs(User::factory()->admin()->create());

        get(route('customer.show', ['customer' => $user]))->assertNotFound();
    });
});
