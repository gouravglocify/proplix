<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         Commands\SubscriptionAlert::class,
         Commands\SubscriptionCancel::class,
         Commands\CheckExpireOrder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('queue:work')
            // ->everyMinute();
        $schedule->command('email:subscriptionAlert')
            ->everyMinute();
        $schedule->command('email:subscriptionCancel')
            ->everyFiveMinutes();
        $schedule->command('command:upgradeSubscription')
            ->everyFifteenMinutes();
            $schedule->command('command:CheckExpireOrder')
                ->everyFifteenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
