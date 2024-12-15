<?php

use App\Models\User;
use App\Services\ChartDataService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('ChartDataService new customer test', function () {
    it('returns an array', function () {
        $result = app(ChartDataService::class)->getRecentCustomerCount();
        expect($result)->toBeArray();
    });

    it('returns an array with 7 keys', function () {
        $result = app(ChartDataService::class)->getRecentCustomerCount();
        expect(count($result))->toBe(7);
    });

    it('gives proper day count', function () {
        $today = Carbon::now();

        User::factory(2)->customer()->create(['created_at' => $today]); // today
        User::factory()->customer()->create(['created_at' => $today->copy()->subDays(1)]); // yesterday
        User::factory(2)->customer()->create(['created_at' => $today->copy()->subDays(2)]); // 13
        User::factory(9)->customer()->create(['created_at' => $today->copy()->subDays(3)]); // 12

        $result = app(ChartDataService::class)->getRecentCustomerCount();

        expect($result[$today->copy()->format('jS M')])->toBe(2)
            ->and($result[$today->copy()->subDays(1)->format('jS M')])->toBe(1)
            ->and($result[$today->copy()->subDays(2)->format('jS M')])->toBe(2)
            ->and($result[$today->copy()->subDays(3)->format('jS M')])->toBe(9);
    });
});
