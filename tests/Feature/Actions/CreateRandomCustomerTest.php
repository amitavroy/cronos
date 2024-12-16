<?php

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

describe('Create Random Customer Test', function () {
   it('creates a random customer', function () {
        Artisan::call('test:create-customer');

        $count = User::where('role', UserRole::CUSTOMER->value)->count();

        expect($count)->toBeGreaterThan(0);
    });
});

