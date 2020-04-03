<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Tweet;

class DeleteTweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete tweets created before eight days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // ===================
        // 自動tweet削除(8日前以前のツイートを削除する)
        // ===================

        //8日前の時間を取得
        $before_eight_days = Carbon::now()->subDay(8);
        $delete_tweet = Tweet::where('created_at', '<', $before_eight_days)->delete();

        logger()->info('８日前以前のツイートデータを削除しました');
    }
}
