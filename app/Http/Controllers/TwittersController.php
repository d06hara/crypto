<?php


namespace App\Http\Controllers;

// require "vendor/autoload.php";

use Coincheck\Coincheck;

use App\Bland;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\User;
use App\Models\TwitterAccount;

// app認証
use App\lib\TwitterAppAuth;

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



        return view('account', [
            'twitter_accounts' => $twitter_accounts
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


        // return view('account', [
        //     "search_users" => $search_users
        // ]);
        // return response()->json(['apple' => 'red', 'peach' => 'pink']);
        // return view('account')->with(['apple' => 'red', 'peach' => 'pink']);
    }

    // アカウントフォロー(api, cors対策)
    public function accountFollow()
    {
        $follow =  \Twitter::post('friendships/create', array('user_id' => 108808407));
        // return $follow;
        // $search_users = \Twitter::get('users/search', array("q" => "仮想通貨", 'count' => 10));
        // return $search_users;
    }

    // DBからツイート件数を取得⇨ランキング画面表示
    public function getTweetCount()
    {
        // ツイートの件数が多い順に銘柄モデルを取得
        $blands = Bland::withCount('tweets')->orderBy('tweets_count', 'desc')->get();
        // dd($blands);
        // 空の配列を用意
        $data = [];



        // coincheck処理
        $strUrl = "https://coincheck.com/api/ticker";
        $file = file_get_contents($strUrl);
        $file = mb_convert_encoding($file, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

        $coin_info = json_decode($file, true);

        // dd($coin_info);


        // ビットコインのデータのみcoincheckから取得したデータを入れる
        foreach ($blands as $bland) {
            if ($bland->bland_name === 'ビットコイン') {
                $data[] = [
                    'id' => $bland->id,
                    'name' => $bland->bland_name,
                    'count' => $bland->tweets_count, //件数へアクセス
                    'high' => $coin_info['high'],
                    'low' => $coin_info['low'],
                    'url' => 'https://twitter.com/search?q=' . urlencode($bland->bland_name) . '&src=typed_query',
                    'display' => true,
                ];
            } else {
                $data[] = [
                    'id' => $bland->id,
                    'name' => $bland->bland_name,
                    'count' => $bland->tweets_count, //件数へアクセス
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
}
