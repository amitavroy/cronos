<?php

namespace App\Domain\Notification\Jobs;

use App\Domain\Notification\Actions\MarkNotificationsAsReadForUserAction;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class MarkNotificationsReadJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param  Collection<(int|string), mixed>  $notificationIds
     */
    public function __construct(
        private readonly ?User $user,
        private readonly Collection $notificationIds
    ) {}

    public function handle(MarkNotificationsAsReadForUserAction $action): void
    {
        if ($this->user === null) {
            return;
        }
        $action->execute(
            notificationIds: $this->notificationIds,
            user: $this->user
        );
    }
}
