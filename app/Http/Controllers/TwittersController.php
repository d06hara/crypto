<?php


namespace App\Http\Controllers;

// require "vendor/autoload.php";

use Coincheck\Coincheck;

use App\Bland;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\User;

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

        // ユーザー認証
        $search_users = \Twitter::get('users/search', array("q" => "あああ", 'count' => 10));
        return $search_users;
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

    // public function test()
    // {
    //     $users = User::all()->take(5);
    //     return $users;
    // }

    // ツイートを取得
    public function tweets()
    {
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
}
