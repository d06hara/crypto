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
        Commands\GetTweetAppAuthCommand::class,
        Commands\GetTwitterAccount::class,
        Commands\AutoFollow::class,
        Commands\DeleteTweet::class,
        Commands\WriteLog::class,
        Commands\UpdateAccount::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('writelog:info')
            ->everyMinute();
        // 自動ツイート取得(10分)
        $schedule->command('gettweet:appauth')
            // ->everyFiveMinutes();
            ->everyTenMinutes()->withoutOverlapping();
        // 自動アカウント取得(10分)
        // $schedule->command('get:twitteraccount')
        //     ->everyTenMinutes()->withoutOverlapping();
        // アカウント更新(10分)
        // $schedule->command('update:account')
        //     ->everyTenMinutes()->withoutOverlapping();
        // 自動フォロー(10分)
        $schedule->command('auto:follow')
            ->everyTenMinutes()->withoutOverlapping();
        // 毎日古いツイートを削除(１日)
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
