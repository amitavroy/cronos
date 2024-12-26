<?php

namespace App\Http\Controllers\Notification;

use App\Domain\Notification\Jobs\MarkNotificationsReadJob;
use App\Domain\Notification\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarkNotificationReadController extends Controller
{
    public function __invoke(Request $request): void
    {
        $postData = $request->validate([
            'ids' => 'required|array',
        ]);

        $notificationIds = Notification::query()
            ->whereIn('id', $postData['ids'])
            ->pluck('id');

        MarkNotificationsReadJob::dispatch(auth()->user(), $notificationIds);
    }
}
