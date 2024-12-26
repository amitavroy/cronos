<?php

namespace App\Domain\Notification\Queries;

use App\Domain\Notification\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class GetUserUnreadNotificationsQuery
{
    public function execute(User $user): Builder
    {
        return Notification::query()
            ->join('user_notification', function (JoinClause $join) use ($user) {
                $join->on('notifications.id', '=', 'user_notification.notification_id')
                    ->where('user_notification.user_id', '=', $user->id)
                    ->where('user_notification.read_at', '=', null);
            })
            ->orderByDesc('notifications.id')
            ->select(['notifications.id', 'notifications.title', 'notifications.message', 'notifications.created_at']);
    }
}
