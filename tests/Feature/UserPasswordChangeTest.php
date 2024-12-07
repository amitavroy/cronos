<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('User password change tests', function () {
    it('changes the password of the user', function () {
        $user = User::factory()->create(['password' => bcrypt('old_password')]);
        actingAs($user);
        $postData = [
            'password' => 'some-random-text',
            'password_confirmation' => 'some-random-text',
            'current_password' => 'old_password',
        ];

        post(route('user.password.change'), $postData);
        $user->refresh();

        $this->assertTrue(\Illuminate\Support\Facades\Hash::check(
            value: 'some-random-text',
            hashedValue: $user->password
        ));
    });

    it('requires new confirm and current password', function () {
        $user = User::factory()->create(['password' => bcrypt('old_password')]);
        actingAs($user);

        post(route('user.password.change'), [])
            ->assertSessionHasErrors(['password', 'current_password']);
    });

    it('does not allow the current password as new password', function () {
        $user = User::factory()->create(['password' => bcrypt('old_password')]);
        actingAs($user);
        $postData = [
            'password' => 'some-random-text',
            'password_confirmation' => 'some-random-text',
            'current_password' => 'some-random-text',
        ];

        post(route('user.password.change'), $postData)
            ->assertSessionHasErrors(['password']);
    });

    it('password and confirm should match', function () {
        $user = User::factory()->create(['password' => bcrypt('old_password')]);
        actingAs($user);
        $postData = [
            'password' => 'some-random-text',
            'password_confirmation' => 'some-random-text-different',
            'current_password' => 'some-random-text-old',
        ];

        post(route('user.password.change'), $postData)
            ->assertSessionHasErrors(['password']);
    });
});
