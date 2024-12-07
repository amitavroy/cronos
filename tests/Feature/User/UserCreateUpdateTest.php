<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('User create tests', function () {
    it('creates a user in db', function () {
        $user = User::factory()->admin()->create();
        actingAs($user);
        $postData = [
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'password' => fake()->password(8),
            'position' => 'Architect',
            'country' => 'India',
        ];

        post(route('user.store'), $postData);

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('users', [
            'email' => $postData['email'],
            'name' => $postData['name'],
        ]);
    });

    it('needs all required fields', function () {
        actingAs(User::factory()->admin()->create());

        post(route('user.store'), [])
            ->assertSessionHasErrors(['name', 'email', 'password', 'position', 'country']);
    });

    it('redirects user to listing', function () {
        $user = User::factory()->admin()->create();

        actingAs($user);

        $postData = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(8),
            'position' => 'Architect',
            'country' => 'India',
        ];

        post(route('user.store'), $postData)
            ->assertRedirectToRoute('user.index');
    });
});

describe('User update tests', function () {
    it('updates the fields', function () {
        $user = User::factory()->admin()->create();

        actingAs($user);

        $postData = [
            'name' => 'Jhon Doe',
            'position' => 'Architect',
            'country' => 'India',
        ];

        patch(route('user.update', ['user' => $user]), $postData);

        $this->assertDatabaseHas('users', array_merge(
            ['id' => $user->id],
            $postData
        ));
    });

    it('needs name position and country', function () {
        $user = User::factory()->admin()->create();

        actingAs($user);

        patch(route('user.update', ['user' => $user]), [])
            ->assertSessionHasErrors(['position', 'country', 'name']);
    });

    it('redirects to the user detail view', function () {
        $user = User::factory()->admin()->create();

        actingAs($user);

        $postData = [
            'name' => fake()->name(),
            'position' => 'Architect',
            'country' => 'India',
        ];

        patch(route('user.update', ['user' => $user]), $postData);

        $this->assertDatabaseHas('users', array_merge(
            ['id' => $user->id],
            $postData
        ));
    });
});
