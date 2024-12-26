<?php

namespace App\Domain\Notification\Actions;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MarkNotificationsAsReadForUserAction
{
    /**
     * @param  Collection<(int|string), mixed>  $notificationIds
     */
    public function execute(Collection $notificationIds, User $user): void
    {
        $notificationIds->each(function ($notificationId) use ($user): void {
            DB::table('user_notification')->where([
                'user_id' => $user->id,
                'notification_id' => $notificationId,
            ])->update(['read_at' => now()]);
        });
    }
}
