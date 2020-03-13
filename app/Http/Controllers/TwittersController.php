<?php


namespace App\Http\Controllers;

// require "vendor/autoload.php";

use Coincheck\Coincheck;

use App\Models\Bland;
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
    // twitterアカウントのログイン機能
    public function twitterLogin()
    {
        return Socialite::driver('twitter')->redirect();
    }
    // 
    public function callback()
    {
        $user = Socialite::driver('Twitter')->user();
        dd($user);
    }

    // twitterアカウント一覧画面表示
    public function index(Request $requiest)
    {
        $twitter_accounts = TwitterAccount::get();

        // dd($twitter_accounts);
        // $twitter_accounts = json_encode($twitter_accounts);



        // 自分のauto_modeの情報も知りたいので自分の情報を取得
        $user_mode = Auth()->user()->auto_mode;



        return view('account', [
            'twitter_accounts' => $twitter_accounts,
            'user_mode' => $user_mode
        ]);


        // ユーザー認証
        // 取得人数はとりあえず10
        // $search_users = \Twitter::get('users/search', array("q" => "仮想通貨", 'count' => 10));
        // return $search_users;
        // $a = json_decode($search_users, true);
        // dd($a);
        // dd($search_users);
        // function is_json($str)
        // {
        //     if (is_array($str)) {
        //         return 'あ';
        //     }
        //     json_decode($str);
        //     if (!json_last_error()) {
        //         return true;
        //     }
        //     return false;
        // }
        // $b = $search_users[0];
        // $a = is_json($b);
        // dd($a);
        // $data = response()->json($search_users[0]);
        // dd($data);
        // return $data;
        // return response()->json(['search_users' => $search_users]);

    }

    // アカウントフォロー(api, cors対策)
    public function accountFollow(Request $request)
    {
        // ＝＝＝＝＝＝＝＝＝＝
        // TODO
        // フォロー済みアカウントをボタンでわかるように
        // idを受け取りフォローするかフォロー解除するか処理を分ける
        // ===============

        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // ログインユーザーのアクセストークンとアクセストークンキーを取得
        $twitterUser = Auth::user()->twitterUser;
        $token = $twitterUser->token;
        $token_secret = $twitterUser->tokenSecret;

        // APIに接続
        $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);

        // vueからフォローするwitter_idを受け取る
        $twitter_id = $request->twitter_id;

        // 受け取ったtwitter_idで紐付くアカウントをフォロー
        $follow =  $connection->post('friendships/create', array('user_id' => $twitter_id));
        dd($follow);
    }



    // 自動アカウントフォロー
    // ここでの処理は使用ユーザーのauto_modeを変更するだけ
    public function autoFollowStart()
    {
        // ログインしているユーザーを取得
        $user = Auth()->user();
        // dd($user->id);

        DB::table('users')->where('id', $user->id)->update([
            'auto_mode' => 1
        ]);
        dd($user->auto_mode);
    }
    public function autoFollowStop()
    {
        // ログインしているユーザーを取得
        $user = Auth()->user();
        // dd($user->id);

        DB::table('users')->where('id', $user->id)->update([
            'auto_mode' => 0
        ]);
        dd($user->auto_mode);
    }

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

    // DBからツイート件数を取得⇨ランキング画面表示
    public function getTweetCount()
    {
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
        return $data;
    }

    // ユーザー取得練習メソッド
    public function getAccountPractice()
    {
        // page 1~25 と26~51で２通りの処理を用意
        // grobal変数としてスイッチ用の変数を用意0と１
        // そのgrobal変数が0のときは1~25で処理し最後に1に変えて、1のときは26~51で処理し0に変える
        // この仕組みで関数が動くたびに処理が入れ替わる

        $total_search_accounts = [];


        // とりあえず
        for ($i = 1; $i < 5; $i++) {
            $search_accounts = \Twitter::get('users/search', array('q' => '仮想通貨', 'page' => $i));
            $total_search_accounts = array_merge($total_search_accounts, $search_accounts);
        };
        // $count = count($total_search_accounts);
        // dd($count);
        // $search_accounts = \Twitter::get('users/search', array('q' => '仮想通貨', 'page' => 51));
        dump($total_search_accounts);
        return view('test', [
            'search_accounts' => $total_search_accounts
        ]);
    }

    public function addTwitterAccount()
    {
    }
}
