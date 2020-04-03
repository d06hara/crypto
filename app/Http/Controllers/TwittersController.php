<?php


namespace App\Http\Controllers;

// require "vendor/autoload.php";

use Coincheck\Coincheck;

use App\Models\Bland;
use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\User;
use App\Models\TwitterAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// app認証
use App\lib\TwitterAppAuth;
use Carbon\Carbon;
// Socialite
use Laravel\Socialite\Facades\Socialite;

class TwittersController extends Controller
{

    public function getTweet()
    {

        // １時間前の時間を取得
        $before_one_hour = Carbon::now()->subHour(1);
        // dd($before_one_hour);
        // 1日前の時間を取得
        $before_one_day = Carbon::now()->subDay(1);
        // dd($before_one_day);

        // １週間前の時間を取得
        $before_one_week = Carbon::now()->subWeek(1);

        // 1週間分のツイート数を銘柄ごとに取得
        $weeks = DB::table('tweets')
            ->select(DB::raw('count(*), bland_id'))
            ->groupBy('bland_id')
            ->where('tweet_created_at', '>', $before_one_week)
            ->get()
            ->toArray();

        // １日分のツイート数を銘柄ごとに取得
        $days = DB::table('tweets')
            ->select(DB::raw('count(*), bland_id'))
            ->groupBy('bland_id')
            ->where('tweet_created_at', '>', $before_one_day)
            ->get()
            ->toArray();

        // 1時間分のツイート数を銘柄ごとに取得
        $hours = DB::table('tweets')
            ->select(DB::raw('count(*), bland_id'))
            ->groupBy('bland_id')
            ->where('tweet_created_at', '>', $before_one_hour)
            ->get()
            ->toArray();

        dd($weeks, $days, $hours);

        // 空の配列を用意
        $arr_week = [];
        $arr_day = [];
        $arr_hour = [];

        foreach ($weeks as $week) {
            $arr_week[] = [
                'bland_id' => $week->bland_id,
                'tweet_count' => $week->count
            ];
        };
        dd($arr_week);


        // 下記の処理は狙い通りの結果が得られるが重すぎるので不採用
        // $tweets = Bland::with(['tweets' => function ($q) use ($before_one_week) {
        //     $q->where('tweet_created_at', '>', $before_one_week);
        // }])->get();


    }
}
