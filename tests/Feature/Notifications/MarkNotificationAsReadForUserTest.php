<?php

use App\Domain\Notification\Actions\MarkNotificationsAsReadForUserAction;
use App\Domain\Notification\Actions\SendNotificationToAllAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Test that notifications are marked as read for a user', function () {
    it('marks notifications as read when notification ids are sent', function () {
        $user = \App\Models\User::factory()->create();
        $notifications = \App\Domain\Notification\Models\Notification::factory()->count(3)->create();

        // sending 3 notifications to all users
        $sendNotification = app(SendNotificationToAllAction::class);
        $notifications->each(function (\App\Domain\Notification\Models\Notification $notification) use ($sendNotification) {
            $sendNotification->execute($notification);
        });

        $notificationIds = $notifications->pluck('id');

        // mark all those notifications as read
        app(MarkNotificationsAsReadForUserAction::class)
            ->execute($notificationIds, $user);

        // create a new notification which will not be read and sending to all
        $notification = \App\Domain\Notification\Models\Notification::factory()->create();
        $sendNotification->execute($notification);

        $readCount = \Illuminate\Support\Facades\DB::table('user_notification')
            ->where('read_at', '!=', null)->count();

        $unreadCount = \Illuminate\Support\Facades\DB::table('user_notification')
            ->where('read_at', null)->count();

        expect($readCount)->toBe(3)->and($unreadCount)->toBe(1);
    });
});
