<?php

use App\Domain\Notification\Actions\SendNotificationToAllAction;
use App\Domain\Notification\Actions\SendNotificationToUsersAction;
use App\Domain\Notification\Models\Notification;
use App\Domain\Notification\Services\NotificationService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('NotificationService test', function () {
    it('returns only the unread notifications', function () {
        $user = User::factory()->create();

        $notification = Notification::factory()->create();
        Notification::factory()->create();

        DB::table('user_notification')->insert([
            'user_id' => $user->id,
            'notification_id' => $notification->id,
            'read_at' => now(),
        ]);

        $service = app(NotificationService::class);

        $notifications = $service->getUserUnreadNotifications($user)->paginate(5);

        expect($notifications->total())->toBe(1);
    });

    it('returns order by id desc', function () {
        $user = User::factory()->create();

        $notification1 = Notification::factory()->create();
        $notification2 = Notification::factory()->create();

        $service = app(NotificationService::class);

        $notifications = $service->getUserUnreadNotifications($user)->get();

        expect($notifications->first()->id)
            ->toBe($notification2->id)
            ->and($notifications->last()->id)
            ->toBe($notification1->id);
    });

    it('adds notification entry for users', function () {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();
        $notification = Notification::factory()->create();

        $service = app(SendNotificationToUsersAction::class);

        $service->execute(
            notification: $notification,
            userIds: collect([$user1->id, $user2->id])
        );

        $count = DB::table('user_notification')
            ->where([
                'notification_id', $notification->id,
                'user_id', $user3->id,
            ])
            ->count();

        expect($count)->toBe(0);
    });

    it('sends notification to all users', function () {
        User::factory(5)->create();

        $notification = Notification::factory()->create();

        $action = app(SendNotificationToAllAction::class);
        $action->execute($notification);

        $count = DB::table('user_notification')->count();

        expect($count)->toBe(5);
    });

    it('does not add records if already exists', function () {
        User::factory(5)->create();

        $notification = Notification::factory()->create();

        $action = app(SendNotificationToAllAction::class);

        $action->execute($notification);
        $action->execute($notification); // sending again

        $count = DB::table('user_notification')->count();

        expect($count)->toBe(5);
    });
});
