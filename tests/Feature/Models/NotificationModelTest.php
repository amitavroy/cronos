<?php

use App\Domain\Notification\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

describe('Notification model test', function () {
    it('belongs to many users', function () {
        $user = User::factory()->create();
        $notification = Notification::factory()->create();

        DB::table('user_notification')->insert([
            'user_id' => $user->id,
            'notification_id' => $notification->id,
            'read_at' => now(),
        ]);

        expect($notification->readByUsers())->toBeInstanceOf(BelongsToMany::class);
    });
});
