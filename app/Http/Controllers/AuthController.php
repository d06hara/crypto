<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

class AuthController extends Controller
{

    public function twitter()
    {

        // dd('a');
        return Socialite::driver('twitter')->redirect();

        // $twitter = new TwitterOAuth(
        //     config('twitter.api_key'),
        //     config('twitter.secret_key')
        // );

        // // dd($twitter);

        // # 認証用のrequest_tokenを取得
        // # このとき認証後、遷移する画面のURLを渡す
        // $token = $twitter->oauth('oauth/request_token', array(
        //     'oauth_callback' => config('twitter.call_back_url')
        // ));

        // // dd($token);

        // # 認証画面で認証を行うためSessionに入れる
        // session(array(
        //     'oauth_token' => $token['oauth_token'],
        //     'oauth_token_secret' => $token['oauth_token_secret'],
        // ));

        // // dd(session());

        // # 認証画面へ移動させる
        // ## 毎回認証をさせたい場合： 'oauth/authorize'
        // ## 再認証が不要な場合： 'oauth/authenticate'
        // $url = $twitter->url('oauth/authorize', array(
        //     'oauth_token' => $token['oauth_token']
        // ));

        // // dd($url);

        // return redirect($url);
    }

    public function twitterCallback(Request $request)
    {

        try {
            // twitterアカウント情報を取得
            $providerUser = Socialite::driver('twitter')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('flash_error', '予期せぬエラーが発生しました');
        }

        // dd($providerUser);

        $authUser = $this->connectTwitterUser($providerUser);

        // 既にログインしているのでここでリダイレクト
        return redirect('/account')->with('flash_message', 'twitterアカウントが登録されました！');
    }

    private function connectTwitterUser($providerUser)
    {
        // 現在のユーザー情報を取得
        $user = Auth::user();

        // dd($user);

        // twitterUserにのみ必要な情報を入れる
        $user->twitterUser()->create([
            'user_id' => $user->id,
            'twitter_id' => $providerUser->getId(),
            'token' => $providerUser->token,
            'tokenSecret' => $providerUser->tokenSecret,
            'nickname' => $providerUser->getNickname(),
            'name' => $providerUser->getName(),
        ]);
    }
}
