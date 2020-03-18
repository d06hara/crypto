<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use App\Models\TwitterUser;
use App\Models\User;
use App\Models\UserAccount;

class TestController extends Controller
{
    // テストメソッド
    public function test()
    {



        $user = auth()->user()->twitterUser;
        $user->accounts()->attach(1);
        dd('aa');
        $twitterUser = $user->accounts()->where('twitter_account_id', 10)->first();
        // $user->accounts()->attach(22);

        // $aa = $user->accounts;
        // dd($aa);
        dd($twitterUser);
        dd((bool) $twitterUser);
    }
}
