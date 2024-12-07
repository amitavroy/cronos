<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Testing the user setting page save', function () {
    test('it saves the data into the database', function () {
        $user = User::factory()->create();
        actingAs($user);

        $postData = [
            'name' => 'Amitav Roy',
            'position' => 'Some unique position',
            'country' => 'India',
        ];

        post(
            uri: route('user-profile.update'),
            data: $postData
        );

        $this->assertDatabaseHas('users', array_merge(['id' => $user->id], $postData));
    });

    it('requires the mandatory field', function () {
        $user = User::factory()->create();
        actingAs($user);

        post(
            uri: route('user-profile.update'),
            data: []
        )->assertSessionHasErrors(['name', 'position', 'country']);
    });
});
