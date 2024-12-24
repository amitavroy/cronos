<?php

use Illuminate\Pagination\LengthAwarePaginator;
use App\Domain\Notification\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\Notification\Services\NotificationService;

uses(RefreshDatabase::class);

describe('NotificationService test', function () {
    it('returns a paginated data list', function () {
        $user = \App\Models\User::factory()->create();

        Notification::factory(5)->create();

        $service = app(NotificationService::class);

        $service->getUserUnreadNotifications($user);

        expect($service->getUserUnreadNotifications($user))
            ->toBeInstanceOf(LengthAwarePaginator::class);
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

        $notifications = $service->getUserUnreadNotifications($user);

        expect($notifications->total())->toBe(1);
    });
});
