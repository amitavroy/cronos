<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\delete;

uses(RefreshDatabase::class);

describe('Notification delete test', function () {
    it('can delete notification', function () {
        $notification = \App\Domain\Notification\Models\Notification::factory()->create();

        $user = User::factory()->admin()->create();

        actingAs($user);

        assertDatabaseCount('notifications', 1);

        delete(route('notification.destroy', ['notification' => $notification]))
            ->assertRedirectToRoute('notification.index');

        assertDatabaseCount('notifications', 0);
    });
});
