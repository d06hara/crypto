<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwittersController extends Controller
{
    // twitterアカウント一覧表示画面
    public function index(Request $requiest)
    {
        $search_users = \Twitter::get('users/search', array("q" => "#仮想通貨", 'count' => 10));
        // dump($search_users);

        return view('account', [
            "search_users" => $search_users
        ]);
    }
}
