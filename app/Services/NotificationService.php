<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\JoinClause;

class NotificationService
{
    /**
     * @return LengthAwarePaginator<Notification>
     */
    public function getUserUnreadNotifications(User $user): LengthAwarePaginator
    {
        return Notification::query()
            ->leftJoin('user_notification', function (JoinClause $join) use ($user) {
                $join->on('notifications.id', '=', 'user_notification.notification_id')
                    ->where('user_notification.user_id', '=', $user->id);
            })
            ->whereNull('user_notification.id')
            ->select(['notifications.id', 'notifications.'])
            ->paginate(10);
    }
}
