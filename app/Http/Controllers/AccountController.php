<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * アカウント一覧画面表示
     */
    public function index()
    {
        // 使用者のauto_modeの状態を画面に渡す
        $user_mode = Auth()->user()->auto_mode;
        // 文字列として渡す
        if ($user_mode === 1) {
            $user_mode = 'true';
        } else {
            $user_mode = 'false';
        }

        return view('account', [
            'user_mode' => $user_mode
        ]);
    }

    /**
     * アカウント取得機能
     */
    public function accountIndex(Request $request)
    {
        // DBからランダムに50件取得
        // twitter_userとのリレーション情報も取得
        $accounts = TwitterAccount::with('users')->inRandomOrder()->take(50)->get();
        if (empty($accounts)) {
            abort(404);
        };
        $accounts = $accounts->toArray();

        // 認証ユーザーがサービス内でフォロー済みかどうか判断する
        // ますは認証ユーザーを取得
        $user = auth()->user()->twitterUser;

        foreach ($accounts as $key => &$value) {
            // 取得したアカウントにリレーション情報がない場合['users] ~ falseとする
            if (empty($value['users'])) {
                $value['users'] = false;
            } else {
                // 取得したアカウントにリレーションがある場合
                // リレーションの中に認証ユーザーがあれば['users'] = true
                // なければ['users'] = falseとする
                // while文でループ処理
                $i = 0;
                while ($i < count($value['users'])) { //リレーションの数だけループ

                    if ($value['users'][$i]['user_id'] === $user->user_id) {
                        $value['users'] = true;
                        break;
                    }
                    $i++;
                }
                // 条件が一致しなかった場合、$value['users']は配列のまま
                if (is_array($value['users'])) {
                    $value['users'] = false;
                }
            };
        };

        // フォロー情報が入った配列を分割し,vueに渡す
        $accounts = array_chunk($accounts, 10);
        $accounts = new LengthAwarePaginator(
            $accounts[$request->page],
            count($accounts),
            10,
            $request->page,
        );

        return $accounts;
    }

    /**
     * アカウントフォロー
     */
    public function accountFollow(Request $request)
    {
        // リクエストからフォロー対象アカウントのDB内account_id, twitter_id, screen_nameを変数に入れる
        $twitter_db_id = $request->account_id;
        $twitter_id = $request->twitter_id;
        $twitter_screen_name = $request->screen_name;

        // ボタンを押したユーザー(認証ユーザー)を取得
        $follower = auth()->user()->twitterUser;

        // リレーションへの記入処理
        $follower->accounts()->attach($twitter_db_id);

        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // 認証ユーザーのアクセストークンとアクセストークンキーを取得
        $token = $follower->token;
        $token_secret = $follower->tokenSecret;

        // 接続
        $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);

        // 受け取ったtwitter_idとscreen_nameでアカウントをフォロー
        $follow =  $connection->post('friendships/create', array(
            'user_id' => $twitter_id,
            'screen_name' => $twitter_screen_name,
            'follow' => false
        ));
    }

    /**
     * アカウントアンフォロー
     */
    public function accountUnfollow(Request $request)
    {
        // リクエストからアンフォロー対象アカウントのDB内id, twitter_id, screen_nameを変数に入れる
        $twitter_id = $request->twitter_id;
        $twitter_db_id = $request->account_id;
        $twitter_screen_name = $request->screen_name;

        // ボタンを押したユーザー(認証ユーザー)を取得
        $follower = auth()->user()->twitterUser;
        // リレーションの削除処理
        $follower->accounts()->detach($twitter_db_id);

        // アクセスキー読み込み
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // 認証ユーザーのアクセストークンとアクセストークンキーを取得
        $token = $follower->token;
        $token_secret = $follower->tokenSecret;

        // 接続
        $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);

        // 受け取ったtwitter_idとscreen_nameでアカウントをアンフォロー
        $unfollow =  $connection->post('friendships/destroy', array(
            'user_id' => $twitter_id,
            'screen_name' => $twitter_screen_name
        ));
    }

    /**
     * 自動フォロースタート
     */
    public function autoFollowStart()
    {
        // ユーザーを取得
        $user = Auth()->user();
        if (is_null($user)) {
            abort(404);
        }
        // ユーザーのauto_modeを１に変更する
        DB::table('users')->where('id', $user->id)->update([
            'auto_mode' => 1
        ]);
    }

    /**
     * 自動フォローストップ
     */
    public function autoFollowStop()
    {
        // ユーザーを取得
        $user = Auth()->user();
        if (is_null($user)) {
            abort(404);
        }
        // ユーザーのauto_modeを0に変更する
        DB::table('users')->where('id', $user->id)->update([
            'auto_mode' => 0
        ]);
    }
}
