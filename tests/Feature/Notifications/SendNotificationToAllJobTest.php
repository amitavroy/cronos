<?php

use App\Domain\Notification\Jobs\SendNotificationToAllJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

describe('Send notification to all job', function () {
    it('sends notification to all users', function () {
        $users = \App\Models\User::factory()->count(3)->create();
        $notification = \App\Domain\Notification\Models\Notification::factory()->create();

        SendNotificationToAllJob::dispatch($notification);

        assertDatabaseCount('user_notification', 3);
    });
});
