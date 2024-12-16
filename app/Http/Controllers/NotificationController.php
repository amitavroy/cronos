<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
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
}
