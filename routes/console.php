<?php

use App\Console\Commands\SyncSegmentDataCommand;
use App\Console\Commands\TestCreateCustomer;
use App\Console\Commands\TestCreateOrderCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(TestCreateOrderCommand::class)
    ->everyMinute();

Schedule::command(TestCreateCustomer::class)
    ->everyMinute();

Schedule::command(SyncSegmentDataCommand::class)
    ->hourly();
