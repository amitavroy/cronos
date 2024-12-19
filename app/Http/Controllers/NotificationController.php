<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Notification;
use Inertia\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreNotificationRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        return inertia('Notification/Create');
    }

    public function store(StoreNotificationRequest $request): RedirectResponse
    {
        Notification::create($request->all());

        return redirect()->route('notification.index');
    }
}
