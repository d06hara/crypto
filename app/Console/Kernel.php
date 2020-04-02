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
        Commands\WriteLog::class,
        Commands\GetTweetCommand::class,
        Commands\GetTweetAppAuthCommand::class,
        Commands\GetTwitterAccount::class,
        Commands\AutoFollow::class,
        Commands\DeleteTweet::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // $schedule->command('writelog:info')
        //     ->everyMinute();
        $schedule->command('gettweet:appauth')
            ->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('get:twitteraccount')
            ->everyFiveMinutes()->withoutOverlapping();
        // 自動フォロー
        $schedule->command('auto:follow')
            ->everyFifteenMinutes()->withoutOverlapping();
        // 毎日古いツイートを削除
        $schedule->command('delete:tweet')
            ->daily()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
