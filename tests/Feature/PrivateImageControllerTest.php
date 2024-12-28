<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Private image controller test', function () {
    it('allows only to authenticated users', function () {
        $response = $this->get(route('private-image'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    });

    it('shows files to auth user', function () {
        Storage::fake('local');

        $file = UploadedFile::fake()->image('profile_picture.jpg');

        $user = \App\Models\User::factory()->create();

        actingAs($user);

        post(route('user.profile-pic.upload'), [
            'profile_pic' => $file,
        ]);

        Storage::disk('local')->assertExists('profile_pictures/'.$file->hashName());

        get(route('private-image', ['filename' => 'profile_pictures/'.$file->hashName()]))
            ->assertStatus(200);
    });

    it('does not show file to guest even if path is correct', function () {
        Storage::fake('local');

        $file = UploadedFile::fake()->image('profile_picture.jpg');

        $user = \App\Models\User::factory()->create();

        actingAs($user);

        post(route('user.profile-pic.upload'), [
            'profile_pic' => $file,
        ]);

        Storage::disk('local')->assertExists('profile_pictures/'.$file->hashName());

        post(route('logout'));

        get(route('private-image', ['filename' => 'profile_pictures/'.$file->hashName()]))
            ->assertRedirectToRoute('login');
    });
});
