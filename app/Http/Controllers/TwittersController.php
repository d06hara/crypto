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

    // twitterアカウント一覧画面表示
    public function index(Request $requiest)
    {
        // $twitter_accounts = TwitterAccount::get();

        // dd($twitter_accounts);
        // $twitter_accounts = json_encode($twitter_accounts);

        // 自分のauto_modeの情報も知りたいので自分の情報を取得
        $user_mode = Auth()->user()->auto_mode;

        return view('account', [
            // 'twitter_accounts' => $twitter_accounts,
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
        // advance
        // 既にフォローしているアカウントの区別をつけるにはどうするか
        // ===============

        // フォローするtwitter_idとtwitter_account_idを取得
        // dd($request);
        $twitter_id = $request->twitter_id;
        // dd($twitter_id);
        $twitter_account_id = $request->account_id;
        // dd($twitter_account_id);

        // 先にこの処理をしないとpost後だと動かない

        // フォローするユーザーを取得
        $follower = auth()->user()->twitterUser;
        // dd($follower);
        // リレーションへの記入処理
        $follower->accounts()->attach($twitter_account_id);
        // dd('フォローしました');

        // 以下、apiを用いたfollw処理

        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // ログインユーザーのアクセストークンとアクセストークンキーを取得
        $twitterUser = Auth::user()->twitterUser;
        // dd($twitterUser);
        $token = $twitterUser->token;
        // dd($token);
        $token_secret = $twitterUser->tokenSecret;
        // dd($token_secret);

        // APIに接続
        $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);
        // dd($connection);

        // 受け取ったtwitter_idで紐付くアカウントをフォロー
        $follow =  $connection->post('friendships/create', array('user_id' => $twitter_id));
        // $follow =  $connection->post('friendships/create', array('user_id' => null));
        // dd($follow);

        // errorチェックよくわからん

        // if (!($follow['id'])) {
        //     // フォローできていない場合
        //     dd('エラー');
        //     // リレーションへの操作を行う
        //     // // フォローするユーザーを取得
        //     // $follower = auth()->user()->twitterUser;
        //     // // リレーションへの記入処理
        //     // $follower->accounts()->attach($twitter_account_id);

        // }
        // dd('a');



        // フォローできている場合
        // // フォローするユーザーを取得
        // $follower = auth()->user()->twitterUser;
        // // dd($follower);
        // // リレーションへの記入処理
        // $follower->accounts()->attach($twitter_account_id);
        // // dd('フォローしました');





        // リレーションへの操作はフォローが問題なく完了した場合に行う

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


    // アカウント取得テスト
    public function addTwitterAccount()
    {

        // $today = Carbon::now();
        // $yesterday = Carbon::now()->subDay();

        // if (!($yesterday->isToday())) {
        //     dd('あああ');
        // }
        // dd($today, $yesterday);

        //  ユーザー認証(twitterOauth使用:ユーザーは自分)
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];
        $manager_token = $config['access_token'];
        $manager_token_secret = $config['access_token_secret'];

        $connection = new TwitterOAuth($key, $secret_key, $manager_token, $manager_token_secret);
        // ---------------------------

        // count20のときpageは1~51まで
        // users/searchのレートリミットは900/15min

        // 1~51までの数字の配列を用意
        // $array_num = range(1, 51);
        // // シャッフルする
        // shuffle($array_num);

        // for ($i = 1; $i < 40; $i++) {
        //     echo $array_num[$i] . "/";
        // }
        // dd($array_num);
        $search_accounts = $connection->get('users/search', array('q' => '仮想通貨', 'page' => 1, 'count' => 10));
        dd($search_accounts);

        $a = $search_accounts[0];
        dd($a->name);


        dd($search_accounts);

        // $ids = array_column($search_accounts, 'id');
        // dd($ids);

        dd($search_accounts);

        // dd($array_num);

        // $search_accounts = $connection->get('users/search', array('q' => '仮想通貨', 'page' => 0, 'count' => 20));

        // dd($search_accounts);
    }
}
