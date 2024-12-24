<?php

namespace App\Http\Controllers;

use App\Domain\Notification\Data\NotificationData;
use App\Domain\Notification\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
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

        return inertia('Notification/Create');
    }

    public function store(NotificationData $notificationData): RedirectResponse
    {
        $this->authorize('create', Notification::class);

        Notification::create($notificationData->toArray());

        return redirect()->route('notification.index');
    }
}
