<?php

namespace App\Http\Controllers\Notification;

use App\Domain\Notification\Data\NotificationData;
use App\Domain\Notification\Jobs\SendNotificationToAllJob;
use App\Domain\Notification\Jobs\SendNotificationToUsersJob;
use App\Domain\Notification\Models\Notification;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class NotificationController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory
    {
        $this->authorize('viewAny', Notification::class);

        $notifications = Notification::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return inertia('Notification/Index', [
            'notifications' => $notifications,
        ]);
    }

    public function create(): Response|ResponseFactory
    {
        $this->authorize('create', Notification::class);

        $users = User::select(['name as label', 'id as value'])
            ->orderBy('name')
            ->get();

        return inertia('Notification/Create', [
            'users' => $users,
        ]);
    }

    public function store(
        NotificationData $notificationData,
        Request $request,
    ): RedirectResponse {
        $this->authorize('create', Notification::class);

        $sendToAll = $request->input('sendToAll', false);

        $notification = Notification::create($notificationData->toArray());

        if ($sendToAll) {
            SendNotificationToAllJob::dispatch($notification);
        }

        if (! $sendToAll && $request->has('users')) {
            SendNotificationToUsersJob::dispatch(
                notification: $notification,
                userIds: collect($request->input('users'))
            );
        }

        return redirect()->route('notification.index');
    }

    public function destroy(Notification $notification): RedirectResponse
    {
        $this->authorize('delete', $notification);

        $notification->delete();

        return redirect()->route('notification.index');
    }
}
