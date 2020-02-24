<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use App\Models\TwitterUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SocialAuthController extends Controller
{




    public function login()
    {
        return Socialite::with('Twitter')->redirect();
    }

    public function callback()
    {
        $checkTwitterUser = Socialite::driver('Twitter')->user();

        // 既に存在するユーザーかを確認
        $twitterUser = TwitterUser::where('provider_user_id', $checkTwitterUser->id)->first();

        // ユーザーidが存在していればログインしてトップページへ
        if ($twitterUser) {
            Auth::login($twitterUser->user, true);
            return redirect('/');
        }

        // ユーザーがいなければ新しいユーザーを作成
        $user = new User();
        $user->name = $twitterUser->name;

        $newTwitterUser = new TwitterUser();
        $newTwitterUser->provider_user_id = $checkTwitterUser->id;

        DB::transaction(function () use ($user, $newTwitterUser) {
            $user->save();
            $user->twitterUser()->save($newTwitterUser);
        });

        Auth::login($user, true);
        return redirect('/');


        // dd($user);
    }
    // public function TwitterRedirect()
    // {
    //     return Socialite::driver('twitter')->redirect();
    // }

    // public function TwitterCallback()
    // {
    //     // OAuthユーザー情報を取得
    //     $social_user = Socialite::driver('twitter')->user();
    //     $user = $this->first_or_create_social_user('twitter', $social_user->id, $social_user->name, $social_user->avatar);

    //     // Laravel 標準の Auth でログイン
    //     \Auth::login($user);

    //     return redirect('/home');
    // }

    // /**
    //  * ログインしたソーシャルアカウントがDBにあるかどうか調べます
    //  *
    //  * @param   string      $service_name       ( twitter , facebook ... )
    //  * @param   int         $social_id          ( 123456789 )
    //  * @param   string      $social_avatar      ( https://....... )
    //  *
    //  * @return  \App\User   $user
    //  *
    //  */
    // protected function first_or_create_social_user(
    //     string $service_name,
    //     int $social_id,
    //     string $social_name,
    //     string $social_avatar
    // ) {
    //     $user = null;
    //     $user = \App\User::where("{$service_name}_id", '=', $social_id)->first();
    //     if ($user === null) {
    //         $user = new \App\User();
    //         $user->fill([
    //             "{$service_name}_id" => $social_id,
    //             'name'               => $social_name,
    //             'avatar'             => $social_avatar,
    //             'password'           => 'DUMMY_PASSWORD',
    //         ]);
    //         $user->save();
    //         return $user;
    //     } else {
    //         return $user;
    //     }
    // }
}
