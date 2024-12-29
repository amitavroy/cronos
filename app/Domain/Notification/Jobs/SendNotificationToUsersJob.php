<?php

namespace App\Domain\Notification\Jobs;

use App\Domain\Notification\Actions\SendNotificationToUsersAction;
use App\Domain\Notification\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class SendNotificationToUsersJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly Notification $notification,
        private readonly Collection $userIds
    ) {}

    public function handle()
    {
        app(SendNotificationToUsersAction::class)->execute(
            notification: $this->notification,
            userIds: $this->userIds
        );
    }
}
