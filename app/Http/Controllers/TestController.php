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

        $a = TwitterAccount::with(['users'])->get();
        $b = $a->map(function ($item, $key) {
            if ($key->users) {
                return $key->users = true;
            }
            return $key->users = false;
        });
        dd($b);
        $b = $a->pluck('twitter_user_id');
        dd($b);
        foreach ($a as $b) {
            if ($b->users) {
                return $b->users = true;
            }
            return $b->users = false;
        }
        dd($a);
        // $user = TwitterUser::with(['accounts'])->get();
        // $user = TwitterUser::find(3)->accounts()->get();
        // $user = auth()->user()->twitterUser::with(['accounts'])->get();
        // $aa = $user;
        // dd($aa);
        // $user = TwitterAccount::with(['users'])->get();

        $user = auth()->user()->twitterUser;
        $twitterUser = $user->accounts()->where('twitter_account_id', 10)->first();
        // $user->accounts()->attach(22);

        // $aa = $user->accounts;
        // dd($aa);
        dd($twitterUser);
        dd((bool) $twitterUser);
    }
}
