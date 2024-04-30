<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class ScheduleServiceProvider extends EventServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('emails:send')->dailyAt('08:00');
        });
    }
}
