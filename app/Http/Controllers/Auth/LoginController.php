<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// Socialite追加
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// logout機能追加のため
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // logout先変更のため書き換え
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/ranking';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * OAuth認証先にリダイレクト
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * OAuth認証の結果受け取り
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            // twitterアカウント情報を取得
            $providerUser = Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('oauth_error', '予期せぬエラーが発生しました');
        }

        dd($providerUser);
        $token = $providerUser->token;
        $tokenSecret = $providerUser->tokenSecret;
        dd($tokenSecret);

        if ($email = $providerUser->getEmail()) {
            Auth::login(User::firstOrCreate([
                'email' => $email
            ], [
                'name' => $providerUser->getName(),
                'twitter_id' => $providerUser->getId(),
                'delete_flg' => 1,
            ]));

            return redirect($this->redirectTo);
        } else {
            return redirect('/login')->with('oauth_error', 'メールアドレスが取得できませんでした');
        }
    }

    // logout機能作成
    public function Logout(Request $request)
    {
        $this->performLogout($request);
        // redirect先をカスタマイズ
        return redirect('/login');
    }
}
