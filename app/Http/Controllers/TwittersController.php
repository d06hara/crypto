<?php


namespace App\Http\Controllers;

// require "vendor/autoload.php";

use Coincheck\Coincheck;

use App\Bland;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwittersController extends Controller
{
    // twitterアカウント一覧画面表示
    public function index(Request $requiest)
    {
        $search_users = \Twitter::get('users/search', array("q" => "#仮想通貨", 'count' => 10));
        // dump($search_users);

        return view('account', [
            "search_users" => $search_users
        ]);
    }

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
        foreach ($blands as $bland) {
            $data[] = [
                'id' => $bland->id,
                'name' => $bland->bland_name,
                'count' => $bland->tweets_count, //件数へアクセス
            ];
        }


        // coincheck処理
        $strUrl = "https://coincheck.com/api/ticker";
        $file = file_get_contents($strUrl);
        $file = mb_convert_encoding($file, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

        $coin_info = json_decode($file, true);


        // dd($coin_info);

        // 連想配列としてviewに渡す
        return view('ranking', [
            "data" => $data,
            "coin_info" => $coin_info
        ]);
    }
}
