<?php

namespace App\Domain\Notification\Actions;

use App\Domain\Notification\Models\Notification;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MarkNotificationsAsReadForUserAction
{
    public function execute(Collection $notificationIds, User $user): void
    {
        $notificationIds->each(function (int $notificationId) use ($user): void {
            DB::table('user_notification')->where([
                'user_id' => $user->id,
                'notification_id' => $notificationId
            ])->update(['read_at' => now()]);
        });
    }
}
