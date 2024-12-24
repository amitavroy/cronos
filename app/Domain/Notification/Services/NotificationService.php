<?php

namespace App\Domain\Notification\Services;

use App\Domain\Notification\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\JoinClause;

class NotificationService
{
    /**
     * @return LengthAwarePaginator<\App\Domain\Notification\Models\Notification>
     */
    public function getUserUnreadNotifications(User $user): LengthAwarePaginator
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
            ->select(['notifications.id', 'notifications.'])
            ->paginate(10);
    }
}
