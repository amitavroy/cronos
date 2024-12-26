<?php

namespace App\Domain\Notification\Actions;

use App\Domain\Notification\Models\Notification;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SendNotificationToAllAction
{
    public function execute(Notification $notification): void
    {
        $count = DB::table('user_notification')
            ->where('notification_id', $notification->id)
            ->count();

        if ($count > 0) {
            return;
        }

        // doing this to go through larastan.
        $users = User::select('id')->get()->toArray();
        $userIds = collect($users)->pluck('id');

        $action = app(SendNotificationToUsersAction::class);
        $userIds->chunk(100)->each(function (Collection $chunk) use ($notification, $action): void {
            $action->execute($notification, $chunk);
        });
    }
}
