<?php

namespace App\Http\Controllers;

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
        // dump($data);
        // 連想配列としてviewに渡す
        return view('ranking', [
            "data" => $data
        ]);
    }
}
