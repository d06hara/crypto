<?php

namespace App\Console\Commands;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Console\Command;
use App\Models\Tweet;


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
        // ===================
        // 自動ツイート取得処理
        // ===================

        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        $connection = new TwitterOAuth($key, $secret_key);


        // 検索したい銘柄キーワードを配列にしておく
        // coincheckで取り扱っている12銘柄
        // それぞれbland_idと対応させる
        // 銘柄を追加する場合はここに追加
        $search_key_array = array(
            1 => "ビットコイン",
            2 => "イーサリアム",
            3 => "イーサリアムクラシック",
            4 => "Lisk OR LSK", //リスクのみ日本語検索なし（仮想通貨と関連がないツイートが多すぎるため)
            5 => "ファクトム",
            6 => "リップル",
            7 => "ネム",
            8 => "ライトコイン",
            9 => "ビットコインキャッシュ",
            10 => "モナコイン",
            11 => "ステラルーメン",
            12 => "クアンタム",
        );

        logger()->info('ツイート取得途中');

        foreach ($search_key_array as $bland_id => $search_key) {

            // bland_idごとに最新のツイートidを取得
            $latest_tweet_id = Tweet::where('bland_id', $bland_id)->max('tweet_id');
            // 最新のツイートidに+1することで重複を防ぐ
            $since_id = $latest_tweet_id + 1;

            $tweet_obj = $connection->get('search/tweets', array(
                "q" => $search_key,
                "count" => 100,
                "lang" => "ja",
                "local" => "ja",
                "result_type" => "mixed",
                "since_id" => $since_id
            ));

            $tweets_arr = $tweet_obj->statuses;

            $twitter_store = Tweet::tweetStore($tweets_arr, $bland_id);
        }

        logger()->info('ツイート取得');
    }
}
