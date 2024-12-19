<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory
    {
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
