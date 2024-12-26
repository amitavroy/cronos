<?php

use App\Domain\Notification\Jobs\SendNotificationToAllJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Notification create test', function () {
    it('creates a notification', function () {
        $this->withoutVite();
        $admin = User::factory()->admin()->create();
        actingAs($admin);

        $postData = [
            'title' => 'Test Notification',
            'message' => 'This is a test notification',
        ];

        post(route('notification.store'), $postData);

        $this->assertDatabaseCount('notifications', 1);
        $this->assertDatabaseHas('notifications', $postData);
    });

    it('can be created by admin only', function () {
        $this->withoutVite();
        $admin = User::factory()->admin()->create();
        $manager = User::factory()->manager()->create();
        $customer = User::factory()->customer()->create();

        $postData = [
            'title' => 'Test Notification',
            'message' => 'This is a test notification',
        ];

        actingAs($admin);
        post(route('notification.store'), $postData)->assertRedirect(route('notification.index'));

        actingAs($manager);
        post(route('notification.store'), $postData)->assertForbidden();

        actingAs($customer);
        post(route('notification.store'), $postData)->assertForbidden();
    });

    it('dispatch a job to send notification to all users', function () {
        \Illuminate\Support\Facades\Queue::fake();
        $this->withoutVite();
        $admin = User::factory()->admin()->create();
        actingAs($admin);

        $postData = [
            'title' => 'Test Notification',
            'message' => 'This is a test notification',
            'sendToAll' => true,
        ];

        post(route('notification.store'), $postData);

        $this->assertDatabaseCount('notifications', 1);
        Queue::assertPushed(SendNotificationToAllJob::class);
    });
});
