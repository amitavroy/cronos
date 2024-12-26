<?php

namespace App\Domain\Notification\Actions;

use App\Domain\Notification\Models\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SendNotificationToUsersAction
{
    /**
     * Make entry for users who should get a specific notification.
     *
     * @param  Collection<int|string, mixed>  $userIds
     */
    public function execute(Notification $notification, Collection $userIds): void
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
}
