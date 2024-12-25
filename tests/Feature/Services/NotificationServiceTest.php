<?php

use App\Domain\Notification\Models\Notification;
use App\Domain\Notification\Services\NotificationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('NotificationService test', function () {
    it('returns a paginated data list', function () {
        $user = \App\Models\User::factory()->create();

        Notification::factory(5)->create();

        $service = app(NotificationService::class);

        $service->getUserUnreadNotifications($user);

        expect($service->getUserUnreadNotifications($user))
            ->toBeInstanceOf(Builder::class);
    });

    it('returns only the unread notifications', function () {
        $user = \App\Models\User::factory()->create();

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
        $user = \App\Models\User::factory()->create();

        $notification1 = Notification::factory()->create();
        $notification2 = Notification::factory()->create();

        $service = app(NotificationService::class);

        $notifications = $service->getUserUnreadNotifications($user)->get();

        expect($notifications->first()->id)
            ->toBe($notification2->id)
            ->and($notifications->last()->id)
            ->toBe($notification1->id);
    });
});
