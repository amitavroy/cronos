<?php

namespace App\Domain\Notification\Services;

use App\Domain\Notification\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NotificationService
{
    public function sendNotificationToAll(Notification $notification): void
    {
        $count = DB::table('user_notification')->where('notification_id', $notification->id)->count();

        if ($count > 0) {
            return;
        }

        // doing this to go through larastan.
        $users = User::select('id')->get()->toArray();
        $userIds = collect($users)->pluck('id');

        $userIds->chunk(100)->each(function (Collection $chunk) use ($notification): void {
            $this->sendNotifictionToUsers($notification, $chunk);
        });
    }

    /**
     * Make entry for users who should get a specific notification.
     *
     * @param  \Illuminate\Support\Collection<int|string, mixed>  $userIds
     */
    public function sendNotifictionToUsers(Notification $notification, Collection $userIds): void
    {
        $records = collect(); // creating the insert data

        $userIds->each(function ($userId) use ($notification, $records) {
            $records->push([
                'user_id' => $userId,
                'notification_id' => $notification->id,
                'read_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        // doing DB insert to have a single query instead of loop
        DB::table('user_notification')->insert($records->toArray());
    }

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
