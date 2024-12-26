<?php

use App\Domain\Notification\Actions\SendNotificationToAllAction;
use App\Domain\Notification\Jobs\MarkNotificationsReadJob;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Mark notification read controller test', function () {
    it('dispatches a job when called', function () {
        \Illuminate\Support\Facades\Queue::fake();

        $user = \App\Models\User::factory()->admin()->create();
        $notification = \App\Domain\Notification\Models\Notification::factory()->create();

        actingAs($user);

        app(SendNotificationToAllAction::class)->execute($notification);

        post(route('notification.mark-read'), [
            'ids' => [$notification->id],
        ]);

        Queue::assertPushed(MarkNotificationsReadJob::class);
    });
})->only();
