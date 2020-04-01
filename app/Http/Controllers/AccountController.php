<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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


        // ユーザー認証
        // 取得人数はとりあえず10
        // $search_users = \Twitter::get('users/search', array("q" => "仮想通貨", 'count' => 10));
        // return $search_users;
        // $a = json_decode($search_users, true);
        // dd($a);
        // dd($search_users);
        // function is_json($str)
        // {
        //     if (is_array($str)) {
        //         return 'あ';
        //     }
        //     json_decode($str);
        //     if (!json_last_error()) {
        //         return true;
        //     }
        //     return false;
        // }
        // $b = $search_users[0];
        // $a = is_json($b);
        // dd($a);
        // $data = response()->json($search_users[0]);
        // dd($data);
        // return $data;
        // return response()->json(['search_users' => $search_users]);

    }


    // アカウント取得機能(api)
    public function accountIndex(Request $request)
    {
        // return TwitterAccount::paginate(10);

        // return TwitterAccount::with(['users'])->paginate(10);

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
        // フォロー済みアカウントをボタンでわかるように
        // idを受け取りフォローするかフォロー解除するか処理を分ける
        // advance
        // 既にフォローしているアカウントの区別をつけるにはどうするか
        // ===============

        // フォローするtwitter_idとtwitter_account_idを取得
        // dd($request);
        $twitter_id = $request->twitter_id;
        // dd($twitter_id);
        $twitter_account_id = $request->account_id;
        // dd($twitter_account_id);
        $twitter_screen_name = $request->screen_name;
        // dd($twitter_screen_name);
        // 先にこの処理をしないとpost後だと動かない

        // フォローするユーザーを取得
        $follower = auth()->user()->twitterUser;
        // dd($follower);
        // リレーションへの記入処理
        $follower->accounts()->attach($twitter_account_id);
        // dd('フォローしました');



        // 以下、apiを用いたfollw処理

        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // ログインユーザーのアクセストークンとアクセストークンキーを取得
        $twitterUser = Auth::user()->twitterUser;
        // dd($twitterUser);
        $token = $twitterUser->token;
        // dd($token);
        $token_secret = $twitterUser->tokenSecret;
        // dd($token_secret);

        // APIに接続
        $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);
        // dd($connection);

        // dd($twitter_id);
        // dd(is_int($twitter_id));

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





        // リレーションへの操作はフォローが問題なく完了した場合に行う

    }
    // アカウントアンフォロー(api, cors対策)
    public function accountUnfollow(Request $request)
    {

        // ＝＝＝＝＝＝＝＝＝＝
        // TODO
        // フォロー済みアカウントをボタンでわかるように
        // idを受け取りフォローするかフォロー解除するか処理を分ける
        // advance
        // 既にフォローしているアカウントの区別をつけるにはどうするか
        // ===============

        // フォローするtwitter_idとtwitter_account_idを取得
        // dd($request);
        $twitter_id = $request->twitter_id;
        // dd($twitter_id);
        $twitter_account_id = $request->account_id;
        // dd($twitter_account_id);
        $twitter_screen_name = $request->screen_name;
        // dd($twitter_screen_name);
        // 先にこの処理をしないとpost後だと動かない

        // フォローするユーザーを取得
        $follower = auth()->user()->twitterUser;
        // dd($follower);
        // リレーションへの記入処理
        $follower->accounts()->detach($twitter_account_id);
        // $follower->accounts()->attach($twitter_account_id);
        // dd('フォローしました');



        // 以下、apiを用いたfollw処理

        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // ログインユーザーのアクセストークンとアクセストークンキーを取得
        $twitterUser = Auth::user()->twitterUser;
        // dd($twitterUser);
        $token = $twitterUser->token;
        // dd($token);
        $token_secret = $twitterUser->tokenSecret;
        // dd($token_secret);

        // APIに接続
        $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);
        // dd($connection);

        // dd($twitter_id);
        // dd(is_int($twitter_id));

        // 受け取ったtwitter_idで紐付くアカウントをフォロー
        $follow =  $connection->post('friendships/destroy', array(
            'user_id' => $twitter_id,
            'screen_name' => $twitter_screen_name
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
