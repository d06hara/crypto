<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = [
        'twitter_id', 'tweet_created_at', 'bland_id'
    ];

    // リレーション設定
    public function bland()
    {
        return $this->belongsTo('App\Models\Bland');
    }

    // ツイートオブジェクトを形成してDBに保存する(ユーザー認証ver)
    public static function tweetStore($tweets_arr, int $bland_id)
    {

        if (is_array($tweets_arr)) {
            // ステータス情報のカウント
            $status_count = count($tweets_arr);

            for ($i = 0; $i < $status_count; $i++) {
                // インスタンスを作成
                $tweet = new Tweet;
                // 取得したツイート情報を変数に格納
                $get_tweet = $tweets_arr[$i];

                // ツイート情報
                $tweet->tweet_id = $get_tweet->id;
                $tweet->tweet_created_at = date('Y-m-d H:i:s', strtotime($get_tweet->created_at));
                // 対応するbland_idを代入
                $tweet->bland_id = $bland_id;
                $tweet->created_at = Carbon::now();
                $tweet->updated_at = Carbon::now();

                // DBヘ保存
                $tweet->save();
            }
        }
    }
}
