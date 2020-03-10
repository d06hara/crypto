<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// Socialite追加
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

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
     * 
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {

        return Socialite::driver('twitter')->redirect();
    }

    /**
     * OAuth認証の結果受け取り
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        try {
            // twitterアカウント情報を取得
            $providerUser = Socialite::driver('twitter')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('oauth_error', '予期せぬエラーが発生しました');
        }

        $authUser = $this->findOrCreateUser($providerUser);

        Auth::login($authUser, true);

        return redirect('/ranking')->with('flash_message', 'ログインしました！');

        // dd($providerUser);
        // $token = $providerUser->token;
        // $tokenSecret = $providerUser->tokenSecret;
        // dd($tokenSecret);

        // アカウントが有するemailが既に登録されているかチェック
        // emailが既に登録されていた場合
        // if (DB::table('users')->where('email', $providerUser->getEmail())->exists()) {

        //     if (Auth::attempt(['email' => $providerUser->getEmail()])) {
        //         return redirect('/ranking');
        //     }

        //     return redirect('/renking')->with('oauth_error', 'アカウントに使用されているEmailは既に登録されています');
        // } else {
        //     // emailが登録されていない場合、新規ユーザーとして登録

        //     // userテーブルに必要な情報を入れる
        //     $user = User::create([
        //         'name' => $providerUser->getName(),
        //         'email' => $providerUser->getEmail(),
        //         'twitter_id' => $providerUser->getId(),
        //     ]);

        //     // twitterUserに必要な情報を入れる
        //     $user->twitterUser()->create([
        //         'user_id' => $user->id,
        //         'twitter_id' => $providerUser->getId(),
        //         'token' => $providerUser->token,
        //         'tokenSecret' => $providerUser->tokenSecret,
        //         'nickname' => $providerUser->getNickname(),
        //         'name' => $providerUser->getName(),

        //     ]);

        //     return redirect('/ranking');
        // }

        // if ($email = $providerUser->getEmail()) {
        //     Auth::login(User::firstOrCreate([
        //         'email' => $email
        //     ], [
        //         'name' => $providerUser->getName(),
        //         'twitter_id' => $providerUser->getId(),

        //     ]));

        //     return redirect($this->redirectTo);
        // } else {
        //     return redirect('/login')->with('oauth_error', 'メールアドレスが取得できませんでした');
        // }
    }

    private function findOrCreateUser($providerUser)
    {

        // 新規ユーザー登録かtwitterアカウントを追加する場合かで処理を分ける
        if (Auth::user()) {

            // そのユーザーがtwitterアカウントを登録しているかチェック
            if (Auth::user()->twitterUser) {
                return redirect('/ranking')->with('flash_message', 'ご利用中のtwitterアカウントは既に他のユーザーに登録されています');
            }
            // ない場合はtwitterアカウントのみ追加で登録

            // 現在のユーザー情報を取得
            $user = Auth::user();

            // twitterUserにのみ必要な情報を入れる
            $user->twitterUser()->create([
                'user_id' => $user->id,
                'twitter_id' => $providerUser->getId(),
                'token' => $providerUser->token,
                'tokenSecret' => $providerUser->tokenSecret,
                'nickname' => $providerUser->getNickname(),
                'name' => $providerUser->getName(),
            ]);

            // 既にログインしているのでここでリダイレクト
            return redirect('/account')->with('flash_message', 'twitterアカウントが登録されました！');
        }


        // twitter_idでuserテーブルを検索
        $authUser = User::where('twitter_id', $providerUser->getId())->first();

        // twitter_idが見つかった場合はそのまま返す
        if ($authUser) {
            return $authUser;
        }
        // なかった場合
        // userテーブルに必要な情報を入れる
        $newUser = User::create([
            'name' => $providerUser->getName(),
            'email' => $providerUser->getEmail(),
            'twitter_id' => $providerUser->getId(),
        ]);

        // twitterUserに必要な情報を入れる
        $newUser->twitterUser()->create([
            'user_id' => $newUser->id,
            'twitter_id' => $providerUser->getId(),
            'token' => $providerUser->token,
            'tokenSecret' => $providerUser->tokenSecret,
            'nickname' => $providerUser->getNickname(),
            'name' => $providerUser->getName(),

        ]);

        return $newUser;
    }

    // logout機能作成
    public function Logout(Request $request)
    {
        $this->performLogout($request);
        // redirect先をカスタマイズ
        return redirect('/login');
    }
}
