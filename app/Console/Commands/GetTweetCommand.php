<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Tweet;

class GetTweetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'getting tweet';

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
        //cronで実行したい処理を記述
        // 検索したいキーワード
        // とりあえずビットコインでモデル作成
        $search_key = "ビットコイン";
        $query = Tweet::get();

        //初期データ
        if (!is_object($query)) {
            //DBから最大値を取得
            $max = $query->max('tweet_id');
            //tweet_idの最大値から+1してDBのデータと被らないようにする
            $since_id = $max + 1;
        } else {
            $since_id = null;
        }
    }
}
