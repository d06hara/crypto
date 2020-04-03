<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\TwitterUser;

class AuthController extends Controller
{

    /**
     * twitterアカウント認証ページへ(Socialite使用)
     */
    public function twitter()
    {

        return Socialite::driver('twitter')->redirect();
    }

    /**
     * twitterアカウント連携処理
     */
    public function twitterCallback(Request $request)
    {

        try {
            // twitterアカウント情報を取得
            $providerUser = Socialite::driver('twitter')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('flash_error', '予期せぬエラーが発生しました');
        }

        // 認証アカウントが既にDBにあるかチェック
        $connected_account = TwitterUser::where('twitter_id', $providerUser->getId())->first();

        if (!is_null($connected_account)) {
            // 認証したアカウントが既に他のユーザーに登録されていた場合
            return redirect('/account')->with('flash_error', 'このtwitterアカウントは既に使用されています');
        }

        // 認証したアカウントが未登録だった場合

        // 認証ユーザーを取得
        $user = Auth::user();

        // 認証ユーザーに紐付くtwitter_userテーブルに必要な情報を入れる
        $user->twitterUser()->create([
            'user_id' => $user->id,
            'twitter_id' => $providerUser->getId(),
            'token' => $providerUser->token,
            'tokenSecret' => $providerUser->tokenSecret,
            'nickname' => $providerUser->getNickname(),
            'name' => $providerUser->getName(),
        ]);

        // 既にログインしているのでアカウントページにリダイレクト
        return redirect('/account')->with('flash_message', 'twitterアカウントが登録されました！');
    }
}
