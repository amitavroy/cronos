<?php

use App\Models\User;
use App\Domain\Notification\Models\Notification;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

describe('User model test', function () {
    it('belongs to many notifications', function () {
        $user = User::factory()->create();
        $notification = Notification::factory()->create();

        DB::table('user_notification')->insert([
            'user_id' => $user->id,
            'notification_id' => $notification->id,
            'read_at' => now(),
        ]);

        expect($user->readNotifications())->toBeInstanceOf(BelongsToMany::class);
    });
});
