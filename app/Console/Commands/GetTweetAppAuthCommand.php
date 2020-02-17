<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tweet;

class GetTweetAppAuthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gettweet:appauth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting tweet by using app auth';

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

        // app認証の準備
        // ------------------------
        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        $query = Tweet::get();
        dd($query);
        //初期データ
        if (!is_object($query)) {
            //DBから最大値を取得
            $max = $query->max('tweet_id');
            //tweet_idの最大値から+1してDBのデータと被らないようにする
            $since_id = $max + 1;
        } else {
            $since_id = null;
        }

        // インスタンス作成
        $connection = new Tweet($key, $secret_key);


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



            // パラメータ
            $params = array(
                // "q" => "BTC",
                "q" => $search_key,
                "count" => 1,
                "lang" => "ja",
                "since_id" => $since_id
            );

            $tweet_obj = $connection->searchTweet('search/tweets', $params);

            //TwitterAPIからデータが返ってきているか確認
            if (is_object($tweet_obj)) {
                //念の為ツイートデータが入ってるか確認
                if (isset($tweet_obj->statuses)) {
                    //ツイート保存する処理
                    $twitter_store = Tweet::tweetStore($tweet_obj, $bland_id);
                    // $twitter_store = Tweet::tweetStore($twitter_api, $bland_id);
                }
            }
            // }

            dd($tweet_obj);
        }

        // $params = array(
        //     'q' => '焼肉',
        //     'count' => 1,
        // );



        // $tweet_obj = $connection->searchTweet('search/tweets', $params);

        $tweets_arr = json_decode($tweet_obj);

        dd($tweets_arr);

        // // ベアラートークン作成
        // $bearer_credentials = rawurlencode($key) . ":" . rawurlencode($secret_key);
        // // $bearer_credentials = rawurlencode($config['api_key']) . ":" . rawurlencode($config['secret_key']);
        // $bearer_token = base64_encode($bearer_credentials);
        // // エンドポイント
        // // $request_url = 'https://twitter.com/search';
        // $request_url = 'https://api.twitter.com/1.1/search/tweets.json';

        // // リクエスト用のコンテキスト
        // $context = array(
        //     'http' => array(
        //         'method' => 'GET', // リクエストメソッド
        //         'header' => array(              // ヘッダー
        //             'Authorization: Bearer ' . $bearer_token,
        //         ),
        //     ),
        // );
        // ------------------------


        // // foreach ($search_key_array as $bland_id => $search_key) {

        // $query = Tweet::get();

        // //初期データ
        // if (!is_object($query)) {
        //     //DBから最大値を取得
        //     $max = $query->max('tweet_id');
        //     //tweet_idの最大値から+1してDBのデータと被らないようにする
        //     $since_id = $max + 1;
        // } else {
        //     $since_id = null;
        // }

        // // パラメータ
        // $params = array(
        //     "q" => "BTC",
        //     // "q" => $search_key,
        //     "count" => 1,
        //     "lang" => "ja",
        //     "since_id" => $since_id
        // );

        // // パラメータに対応したリクエストurl
        // if ($params) {
        //     $request_url .= '?' . http_build_query($params);
        // }

        // // TwitterAPIでデータを取得
        // $twitter_api = Tweet::getTweetAppAuth($context, $request_url);

        // //TwitterAPIからデータが返ってきているか確認
        // // if (is_object($twitter_api)) {
        // //念の為ツイートデータが入ってるか確認
        // if (isset($twitter_api->statuses)) {
        //     //ツイート保存する処理
        //     $twitter_store = Tweet::tweetStore($twitter_api, 1);
        //     // $twitter_store = Tweet::tweetStore($twitter_api, $bland_id);
        // }
        // // }
        // // }
    }
}
