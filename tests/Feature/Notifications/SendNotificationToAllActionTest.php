<?php

use App\Domain\Notification\Actions\SendNotificationToAllAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Send notification to all action test', function () {
    it('sends notification to all users', function () {
        $notification = \App\Domain\Notification\Models\Notification::factory()->create();
        \App\Models\User::factory(5)->create();

        app(SendNotificationToAllAction::class)->execute($notification);

        $this->assertDatabaseCount('user_notification', 5);
    });
});
