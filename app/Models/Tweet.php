<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = [
        'twitter_id', 'tweet_created_at', 'bland_id'
    ];

    // リレーション設定
    public function bland()
    {
        return $this->belongsTo('App\Bland');
    }

    // app authお試し
    // --------------------------------------------
    // private $bearer_token;

    // public function __construct($consumer_key, $consumer_secret)
    // {
    //     $this->_bearer_token = $this->_getBearerToken($consumer_key, $consumer_secret);
    // }

    // private function _getBearerToken($consumer_key, $consumer_secret)
    // {
    //     $oauth2_url = 'https://api.twitter.com/oauth2/token';

    //     $token = base64_encode(urlencode($consumer_key) . ':' . urlencode($consumer_secret));

    //     $request = array(
    //         'grant_type' => 'client_credentials'
    //     );

    //     $opts['http'] = array(
    //         'method'    => 'POST',
    //         'header'    => 'Content-type: application/x-www-form-urlencoded;charset=UTF-8' . "\r\n"
    //             . 'Authorization: Basic ' . $token,
    //         'content'   => http_build_query($request, '', '&', PHP_QUERY_RFC3986)
    //     );

    //     $context = stream_context_create($opts);

    //     $response_json = file_get_contents($oauth2_url, false, $context);

    //     $response_arr = json_decode($response_json, true);

    //     return $response_arr['access_token'];
    // }

    // public function searchTweet($api, $params = array())
    // {
    //     $api_url = 'https://api.twitter.com/1.1/' . $api . '.json';

    //     if ($params) {
    //         $request = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    //         $api_url .= '?' . $request;
    //     }

    //     $opts['http'] = array(
    //         'header' => 'Authorization: Bearer ' . $this->_bearer_token
    //     );

    //     $context = stream_context_create($opts);

    //     return file_get_contents($api_url, false, $context);
    // }
    // ---------------------------------------------


    // created_atとupdated_atは使わないのでfalseに
    public $timestamps = false;

    // 最新のツイートを取得する(ユーザー認証ver)
    // public static function getTweetLatestApi(string $search_key, int $since_id = null)
    // {
    //     // twitterapiを呼び出しデータを取得する
    //     $twitter_api = \Twitter::get("search/tweets", [
    //         'q' => $search_key,
    //         // １度に最大100件のツイートを取得
    //         'count' => 100,
    //         // とりあえず日本語のツイートのみ（変更可能）
    //         'lang' => 'ja',
    //         'since_id' => $since_id
    //     ]);

    //     return $twitter_api;
    // }

    // ツイートオブジェクトを形成してDBに保存する(ユーザー認証ver)
    public static function tweetStore($twitter_api, int $bland_id)
    {
        // ステータス情報の取得
        $statuses = $twitter_api->statuses;

        if (is_array($statuses)) {
            // ステータス情報のカウント
            $status_count = count($statuses);

            for ($i = 0; $i < $status_count; $i++) {
                // インスタンスを作成
                $tweet = new Tweet;
                // 取得したツイート情報を変数に格納
                $status = $statuses[$i];

                // ツイート情報
                $tweet->tweet_id = $status->id;
                $tweet->tweet_created_at = date('Y-m-d H:i:s', strtotime($status->created_at));
                // 対応するbland_idを代入
                $tweet->bland_id = $bland_id;

                // DBヘ保存
                $tweet->save();
            }
        }
    }
}
