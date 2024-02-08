<?php

namespace App\Console;

use App\Console\Commands\Vk\ProcessUnprocessedEvents;
use App\Console\Commands\Vk\RemoveOldEventsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command((new RemoveOldEventsCommand())->getName())->everySixHours();
        $schedule->command((new ProcessUnprocessedEvents())->getName())->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
