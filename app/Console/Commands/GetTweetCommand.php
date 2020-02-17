<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tweet;

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

        // 検索したい銘柄キーワードを配列にしておく
        // 日本で取り扱っている有名銘柄10種
        // それぞれbland_idと対応させる
        // 銘柄を追加する場合はここに追加
        $search_key_array = array(
            1 => "ビットコイン OR Bitcoin OR BTC",
            2 => "ビットコインキャッシュ OR BitcoinCash OR BCH",
            3 => "イーサリアム OR Ethereum OR ETH",
            4 => "イーサリアムクラシック OR EthreumClassic OR ETC",
            5 => "リップル OR Ripple OR XRP",
            6 => "ライトコイン OR LiteCoin OR LTC",
            7 => "ネム OR NEM OR XEM",
            8 => "モナコイン OR  MonaCoin OR MONA",
            9 => "リスク OR Lisk OR LSK",
            10 => "ファクトム OR Factom OR FCT",
        );

        foreach ($search_key_array as $bland_id => $search_key) {

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

            // TwitterAPIでデータを取得
            $twitter_api = Tweet::getTweetLatestApi($search_key, $since_id);

            //TwitterAPIからデータが返ってきているか確認
            if (is_object($twitter_api)) {
                //念の為ツイートデータが入ってるか確認
                if (isset($twitter_api->statuses)) {
                    //ツイート保存する処理
                    $twitter_store = Tweet::tweetStore($twitter_api, $bland_id);
                }
            }
        }
    }
}
