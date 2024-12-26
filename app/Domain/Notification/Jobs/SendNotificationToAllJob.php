<?php

namespace App\Domain\Notification\Jobs;

use App\Domain\Notification\Actions\SendNotificationToAllAction;
use App\Domain\Notification\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNotificationToAllJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Notification $notification) {}

    public function handle(SendNotificationToAllAction $action): void
    {
        $action->execute($this->notification);
    }
}
