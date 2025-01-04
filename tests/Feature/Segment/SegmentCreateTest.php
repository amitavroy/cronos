<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Segment create test', function () {
    it('requires name and description', function () {
        $user = \App\Models\User::factory()->admin()->create();

        actingAs($user);

        post(route('segment.store'), [])->assertSessionHasErrors(['name', 'description']);
    });

    it('creates a segment', function () {
        $user = \App\Models\User::factory()->admin()->create();

        actingAs($user);

        $postData = ['name' => 'Segment 1', 'description' => 'Description 1'];

        post(route('segment.store'), $postData);

        assertDatabaseHas('segments', $postData);
    });

    it('redirects to the index page', function () {
        $user = \App\Models\User::factory()->admin()->create();

        actingAs($user);

        $postData = ['name' => 'Segment 1', 'description' => 'Description 1'];

        post(route('segment.store'), $postData)
            ->assertRedirect(route('segment.index'));
    });

    it('creates a segment which is active', function () {
        $user = \App\Models\User::factory()->admin()->create();

        actingAs($user);

        $postData = ['name' => 'Segment 1', 'description' => 'Description 1'];

        post(route('segment.store'), $postData);

        assertDatabaseHas('segments', ['is_active' => true]);
    });
});
