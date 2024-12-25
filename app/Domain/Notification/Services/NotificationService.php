<?php

namespace App\Domain\Notification\Services;

use App\Domain\Notification\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class NotificationService
{
    /**
     * @return Builder<Notification>
     */
    public function getUserUnreadNotifications(User $user): Builder
    {
        return Notification::query()
            ->leftJoin('user_notification', function (JoinClause $join) use ($user) {
                $join->on(
                    first: 'notifications.id',
                    operator: '=',
                    second: 'user_notification.notification_id'
                )
                    ->where('user_notification.user_id', '=', $user->id);
            })
            ->whereNull('user_notification.id')
            ->orderByDesc('notifications.id')
            ->select(['notifications.id', 'notifications.title', 'notifications.message', 'notifications.created_at']);
    }
}
