<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

// Artisan::command('schedule:run', function () {
//     $this->comment('Running scheduled tasks...');
// });



app('Illuminate\Console\Scheduling\Schedule')->command('email:send-reminder-input')
    ->daily()
    ->when(function () {
        $day = now()->day;
        return $day >= 10 && $day <= 15; // Run only from 1st to 15th of the month
    })->between('08:00', '17:00')
    ->withoutOverlapping(); // Run only between 8 AM and 5 PM

app('Illuminate\Console\Scheduling\Schedule')->command('email:send-reminder-check1')
    ->daily()
    ->when(function () {
        $day = now()->day;
        return $day >= 10 && $day <= 15; // Run only from 10th to 15th of the month
    })->between('08:00', '17:00')
    ->withoutOverlapping(); // Run only between 8 AM and 5 PM

app('Illuminate\Console\Scheduling\Schedule')->command('email:send-reminder-check2')
    ->daily()
    ->when(function () {
        $day = now()->day;
        return $day >= 16 && $day <= 20; // Run only from 21st to 25th of the month
    })->between('08:00', '17:00')
    ->withoutOverlapping(); // Run only between 8 AM and 5 PM

app('Illuminate\Console\Scheduling\Schedule')->command('email:send-reminder-approve')
    ->daily()
    ->when(function () {
        $day = now()->day;
        return $day >= 21 && $day <= 25; // Run only from 21st to 25th of the month
    })->between('08:00', '17:00')
    ->withoutOverlapping(); // Run only between 8 AM and 5 PM
