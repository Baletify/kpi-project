<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('schedule:run', function () {
    $this->comment('Running scheduled tasks...');
});

app('Illuminate\Console\Scheduling\Schedule')->command('email:send-reminder-input')
    ->daily()
    ->when(function () {
        $day = now()->day;
        return $day >= 1 && $day <= 15; // Run only from 1st to 15th of the month
    });
