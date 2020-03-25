<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Bland;
use Carbon\Carbon;

class RankingController extends Controller
{
    // DBからツイート件数を取得⇨ランキング画面表示
    public function getTweetCount()
    {
        // DBの更新日時を取得
        $recent_time = Tweet::max('created_at');
        // dd($recent_time);

        // １時間前の時間を取得
        $before_one_hour = Carbon::now()->subHour(1);
        // dd($before_one_hour);
        // 1日前の時間を取得
        $before_one_day = Carbon::now()->subDay(1);
        // dd($before_one_day);

        // １週間前の時間を取得
        $before_one_week = Carbon::now()->subWeek(1);
        // ツイートの件数が多い順に銘柄モデルを取得
        $blands = Bland::withCount([
            'tweets as hour_tweets_count' => function ($q) use ($before_one_hour) {
                $q->where('tweet_created_at', '>', $before_one_hour);
            },
            'tweets as day_tweets_count' => function ($q) use ($before_one_day) {
                $q->where('tweet_created_at', '>', $before_one_day);
            },
            'tweets as week_tweets_count' => function ($q) use ($before_one_week) {
                $q->where('tweet_created_at', '>', $before_one_week);
            },
        ])->get();
        // $blands = Bland::withCount('tweets')->orderBy('tweets_count', 'desc')->get();
        // dd($blands);
        // 空の配列を用意
        $data = [];

        // coincheck処理
        $strUrl = "https://coincheck.com/api/ticker";
        $file = file_get_contents($strUrl);
        $file = mb_convert_encoding($file, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

        $coin_info = json_decode($file, true);

        // ビットコインのデータのみcoincheckから取得したデータを入れる
        foreach ($blands as $bland) {
            if ($bland->bland_name === 'ビットコイン') {
                $data[] = [
                    'id' => $bland->id,
                    'name' => $bland->bland_name,
                    'hour_tweets_count' => $bland->hour_tweets_count, //件数へアクセス
                    'day_tweets_count' => $bland->day_tweets_count, //件数へアクセス
                    'week_tweets_count' => $bland->week_tweets_count, //件数へアクセス
                    'high' => $coin_info['high'],
                    'low' => $coin_info['low'],
                    'url' => 'https://twitter.com/search?q=' . urlencode($bland->bland_name) . '&src=typed_query',
                    'display' => true,
                ];
            } else {
                $data[] = [
                    'id' => $bland->id,
                    'name' => $bland->bland_name,
                    'hour_tweets_count' => $bland->hour_tweets_count, //件数へアクセス
                    'day_tweets_count' => $bland->day_tweets_count, //件数へアクセス
                    'week_tweets_count' => $bland->week_tweets_count, //件数へアクセス
                    'high' => '不明',
                    'low' => '不明',
                    'url' => 'https://twitter.com/search?q=' . urlencode($bland->bland_name) . '&src=typed_query',
                    'display' => true,
                ];
            }
        }
        // dd($data);

        // dd($coin_info);

        // 連想配列としてviewに渡す
        // return view('ranking', [
        //     "data" => $data,
        //     "coin_info" => $coin_info
        // ]);

        // dd($data);
        return [$recent_time, $data];
    }
}
