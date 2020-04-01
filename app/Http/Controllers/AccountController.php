<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

class AccountController extends Controller
{
    // アカウント一覧画面表示
    public function index()
    {
        // $twitter_accounts = TwitterAccount::get();

        // dd($twitter_accounts);
        // $twitter_accounts = json_encode($twitter_accounts);

        // 自分のauto_modeの情報も知りたいので自分の情報を取得
        $user_mode = Auth()->user()->auto_mode;

        return view('account', [
            // 'twitter_accounts' => $twitter_accounts,
            'user_mode' => $user_mode
        ]);
    }


    // アカウント取得機能(api)
    public function accountIndex(Request $request)
    {
        // DBからランダムに50件取得
        $accounts = TwitterAccount::with('users')->inRandomOrder()->take(50)->get();
        // dd($accounts);
        $accounts = $accounts->toArray();
        // dd($accounts);
        foreach ($accounts as $key => &$value) {
            if (empty($value['users'])) {
                $value['users'] = false;
            } else {
                $value['users'] = true;
            };
        };
        $accounts = array_chunk($accounts, 10);
        $accounts = new LengthAwarePaginator(
            // $accounts,
            $accounts[$request->page],
            count($accounts),
            10,
            $request->page,
        );
        // $accounts = new LengthAwarePaginator(
        //     $accounts->forPage($request->page, 10),
        //     count($accounts),
        //     10,
        //     $request->page,
        // );
        // $accounts = json_encode($accounts);

        return $accounts;
    }
    // アカウントフォロー(api, cors対策)
    public function accountFollow(Request $request)
    {

        // ＝＝＝＝＝＝＝＝＝＝
        // TODO
        // advance
        // 既にフォローしているアカウントの区別をつけるにはどうするか
        // ===============

        // リクエストからフォロー対象アカウントのDB内id, twitter_id, screen_nameを変数に入れる
        $twitter_db_id = $request->account_id;
        $twitter_id = $request->twitter_id;
        $twitter_screen_name = $request->screen_name;

        // ボタンを押したユーザーを取得
        $follower = auth()->user()->twitterUser;

        // リレーションへの記入処理
        $follower->accounts()->attach($twitter_db_id);


        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // ログインユーザーのアクセストークンとアクセストークンキーを取得し、変数へ代入
        $twitterUser = Auth::user()->twitterUser;
        $token = $twitterUser->token;
        $token_secret = $twitterUser->tokenSecret;

        // 接続
        $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);

        // 受け取ったtwitter_idで紐付くアカウントをフォロー
        $follow =  $connection->post('friendships/create', array(
            'user_id' => $twitter_id,
            'screen_name' => $twitter_screen_name,
            'follow' => false
        ));
        // $follow =  $connection->post('friendships/create', array('user_id' => null));
        dd($follow);

        // errorチェックよくわからん

        // if (!($follow['id'])) {
        //     // フォローできていない場合
        //     dd('エラー');
        //     // リレーションへの操作を行う
        //     // // フォローするユーザーを取得
        //     // $follower = auth()->user()->twitterUser;
        //     // // リレーションへの記入処理
        //     // $follower->accounts()->attach($twitter_account_id);

        // }
        // dd('a');



        // フォローできている場合
        // // フォローするユーザーを取得
        // $follower = auth()->user()->twitterUser;
        // // dd($follower);
        // // リレーションへの記入処理
        // $follower->accounts()->attach($twitter_account_id);
        // // dd('フォローしました');

    }
    // アカウントアンフォロー(api, cors対策)
    public function accountUnfollow(Request $request)
    {

        // ＝＝＝＝＝＝＝＝＝＝
        // TODO
        // advance
        // 既にフォローしているアカウントの区別をつけるにはどうするか
        // ===============

        // リクエストからアンフォロー対象アカウントのDB内id, twitter_id, screen_nameを変数に入れる
        $twitter_id = $request->twitter_id;
        $twitter_db_id = $request->account_id;
        $twitter_screen_name = $request->screen_name;

        // ボタンを押したユーザーを取得
        $follower = auth()->user()->twitterUser;
        // リレーションへの記入処理
        $follower->accounts()->detach($twitter_db_id);

        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // ログインユーザーのアクセストークンとアクセストークンキーを取得し、変数へ代入
        $twitterUser = Auth::user()->twitterUser;
        $token = $twitterUser->token;
        $token_secret = $twitterUser->tokenSecret;

        // 接続
        $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);

        // 受け取ったtwitter_idで紐付くアカウントをフォロー
        $follow =  $connection->post('friendships/destroy', array(
            'user_id' => $twitter_id,
            'screen_name' => $twitter_screen_name
        ));
        dd($follow);

        // errorチェックよくわからん

        // if (!($follow['id'])) {
        //     // フォローできていない場合
        //     dd('エラー');
        //     // リレーションへの操作を行う
        //     // // フォローするユーザーを取得
        //     // $follower = auth()->user()->twitterUser;
        //     // // リレーションへの記入処理
        //     // $follower->accounts()->attach($twitter_account_id);

        // }
        // dd('a');

    }



    // 自動アカウントフォロー
    // ここでの処理は使用ユーザーのauto_modeを変更するだけ
    public function autoFollowStart()
    {
        // ログインしているユーザーを取得
        $user = Auth()->user();
        // dd($user->id);

        DB::table('users')->where('id', $user->id)->update([
            'auto_mode' => 1
        ]);
        dd($user->auto_mode);
    }
    public function autoFollowStop()
    {
        // ログインしているユーザーを取得
        $user = Auth()->user();
        // dd($user->id);

        DB::table('users')->where('id', $user->id)->update([
            'auto_mode' => 0
        ]);
        dd($user->auto_mode);
    }
}
