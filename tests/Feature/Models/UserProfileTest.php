<?php

use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User profile model test', function () {
    it('gives default image for profile pic', function () {
        $userProfile = UserProfile::factory()->create([
            'profile_pic' => null,
        ]);

        expect($userProfile->profile_pic)->toEqual(config('app.default_profile_pic'));
    });

    it('gives the url when the url is updated', function () {
        $url = 'http://something';
        $userProfile = UserProfile::factory()->create([
            'profile_pic' => $url,
        ]);

        expect($userProfile->profile_pic)
            ->toEqual(route('private-image', ['filename' => $url]));
    });

    it('belongs to a user', function () {
        $userProfile = UserProfile::factory()->create();

        expect($userProfile->user)->toBeInstanceOf(\App\Models\User::class);
    });
});
