<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use App\Models\TwitterUser;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Pagination\LengthAwarePaginator;

class TestController extends Controller
{
    // テストメソッド
    public function test()
    {
        $twitter_user = TwitterUser::where('twitter_id', 1231135)->first();
        // dd($twitter_user);

        if (!is_null($twitter_user)) {
            dd('aaa');
        }
        dd('a');





        // $twitterUser = TwitterAccount::with('users')->all();
        $twitterUser = TwitterAccount::with('users')->get();
        // dd($twitterUser);

        $collect = $twitterUser->toArray();
        // dd($collect);

        foreach ($collect as $key => &$value) {
            if (empty($value['users'])) {
                $value['users'] = false;
            } else {
                $value['users'] = true;
            };
        };
        // $collect = json_encode($collect);
        // dd($collect);

        $collect = new LengthAwarePaginator(
            $collect,
            count($collect),
            10,
            1,
        );
        // $collect = json_encode($collect);
        dd($collect);

        // dd($collect = $twitterUser->take(3)->toArray());
        // foreach ($collect as $users) {
        //     if (empty($users->users)) {
        //         $users->users = false;
        //     } else {
        //         $users->users = true;
        //     }
        // }

        $new_collection = $collect->map(function ($key, $value) {
            if ($value->users) {
                return $value->users = true;
            } else {
                return $value->users = false;
            }
        });
        dd($new_collection);
        // dd($collect);
        // dd($collect->toArray());
        // // $twitterUser->toArray();
        // dd($twitterUser->toArray());
        // dd($users);

        // $twitterUser = $twitterUser->paginate(10);

        dd($twitterUser);

        $user = auth()->user()->twitterUser;
        // $user->accounts()->attach(1);
        dd('aa');
        $twitterUser = $user->accounts()->where('twitter_account_id', 10)->first();
        // $user->accounts()->attach(22);

        // $aa = $user->accounts;
        // dd($aa);
        dd($twitterUser);
        dd((bool) $twitterUser);
    }
}
