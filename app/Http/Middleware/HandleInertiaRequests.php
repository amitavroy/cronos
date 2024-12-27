<?php

namespace App\Http\Middleware;

use App\Domain\Notification\Data\NotificationData;
use App\Domain\Notification\Queries\GetUserUnreadNotificationsQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @phpstan-ignore-next-line
     */
    public function share(Request $request): array
    {
        $notificationQuery = app(GetUserUnreadNotificationsQuery::class);

        $authUser = null;
        if (Auth::check()) {
            $authUser = $request->user()
                ->load('profile')
                ->only('id', 'name', 'email', 'role');

            $authUser['profile_pic'] = $request->user()->profile->profile_pic;
        }

        return array_merge(parent::share($request), [
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
            ],
            'app' => [
                'name' => config('app.name'),
                'default_email' => app('env') === 'local' ? config('app.default_credentials.email') : '',
                'default_password' => app('env') === 'local' ? config('app.default_credentials.password') : '',
            ],
            'auth' => [
                'user' => $authUser,
                'notifications' => $request->user() ?
                    NotificationData::collect($notificationQuery->execute($request->user())->limit(5)->get()) :
                    null,
            ],
        ]);
    }
}
