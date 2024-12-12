<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('User login test', function () {
    it('redirects to home', function () {
        $postData = [
            'email' => fake()->unique()->email(),
            'password' => fake()->password(minLength: 8),
        ];

        \App\Models\User::factory()->create($postData);

        post(route('login'), $postData)
            ->assertRedirectToRoute('home');
    });

    it('logs user in', function () {
        $postData = [
            'email' => fake()->unique()->email(),
            'password' => fake()->password(minLength: 8),
        ];

        \App\Models\User::factory()->create($postData);

        post(route('login'), array_merge($postData, [
            'remember' => true,
        ]))->assertRedirectToRoute('home');

        expect(Auth::check())->toBeTrue();
    });

    it('requires username and password', function () {
        post(route('login'), [])
            ->assertSessionHasErrors(['email', 'password']);
    });

    it('takes user to login if things fail', function () {
        $postData = [
            'email' => fake()->unique()->email(),
            'password' => fake()->password(minLength: 8),
        ];

        post(route('login'), array_merge($postData, [
            'remember' => true,
        ]))->assertRedirectToRoute('login');
    });
});
