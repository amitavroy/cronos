<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('User logout test', function () {
    it('User is able to logout', function () {
        $user = User::factory()->create();

        actingAs($user);

        post(route('logout'));

        expect(Auth::check())->toBeFalse();
    });

    it('User is redirect to login', function () {
        $user = User::factory()->create();

        actingAs($user);

        post(route('logout'))
            ->assertRedirectToRoute('login');
    });
});
