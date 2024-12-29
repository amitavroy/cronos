<?php

use App\Domain\Notification\Jobs\MarkNotificationsReadJob;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

describe('Mark notifications read job test', function () {
    it('marks the notifications as read', function () {
        $user = \App\Models\User::factory()->create();
        $notification = \App\Domain\Notification\Models\Notification::factory()->create();
        \Illuminate\Support\Facades\DB::table('user_notification')->insert([
            'user_id' => $user->id,
            'notification_id' => $notification->id,
        ]);

        MarkNotificationsReadJob::dispatch($user, collect([$notification->id]));

        assertDatabaseHas('user_notification', [
            'notification_id' => $notification->id,
        ]);
    });
});
