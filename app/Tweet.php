<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    // created_atとupdated_atは使わないのでfalseに
    public $timestamps = false;

    // 最新のツイートを取得する
    public static function getTweetLatestApi(string $search_key, int $since_id = null)
    {
        // twitterapiを呼び出しデータを取得する
        $twitter_api = \Twitter::get("search/tweets", [
            'q' => $search_key,
            // １度に最大100件のツイートを取得
            'count' => 100,
            // とりあえず日本語のツイートのみ（変更可能）
            'lang' => 'ja',
            'since_id' => $since_id
        ]);

        return $twitter_api;
    }

    // ツイートオブジェクトを形成してDBに保存する
    public static function tweetStore(object $twitter_api, int $bland_id)
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
                $tweet->text = $status->text;
                $tweet->tweet_created_at = date('Y-m-d H:i:s', strtotime($status->created_at));
                // 対応するbland_idを代入
                $tweet->bland_id = $bland_id;

                // DBヘ保存
                $tweet->save();
            }
        }
    }
}
