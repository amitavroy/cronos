<?php

use App\Domain\Notification\Jobs\SendNotificationToUsersJob;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

describe('Send notification to users job', function () {
    it('sends notification to users', function () {
        $users = \App\Models\User::factory()->count(3)->create();

        $notification = \App\Domain\Notification\Models\Notification::factory()->create();

        SendNotificationToUsersJob::dispatch($notification, collect($users->pluck('id')));

        assertDatabaseCount('user_notification', 3);
    });
});
