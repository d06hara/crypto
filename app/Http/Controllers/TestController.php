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
        // $user = TwitterUser::with(['accounts'])->get();
        // $user = TwitterUser::find(3)->accounts()->get();
        // $user = auth()->user()->twitterUser::with(['accounts'])->get();
        // $aa = $user;
        // dd($aa);
        // $user = TwitterAccount::with(['users'])->get();

        $user = auth()->user()->twitterUser;
        $twitterUser = $user->accounts()->where('twitter_account_id', 10)->first();
        $user->accounts()->attach(22);

        // $aa = $user->accounts;
        // dd($aa);
        dd((bool) $twitterUser);
    }
}
