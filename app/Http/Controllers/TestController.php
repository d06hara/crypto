<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use App\Models\TwitterUser;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Abraham\TwitterOAuth\TwitterOAuth;

use function GuzzleHttp\json_decode;

class TestController extends Controller
{
    // テストメソッド
    public function test()
    {

        // $follow_targets = DB::table('twitter_accounts')->pluck('twitter_id', 'screen_name');
        // // $follow_targets = TwitterAccount::get('twitter_id');
        // // $follow_targets = json_decode($follow_targets);
        // $follow_targets = $follow_targets->toArray();
        // // dd($follow_targets->toArray());
        // $config = config('twitter');
        // $key = $config['api_key'];
        // $secret_key = $config['secret_key'];

        // $auto_mode_users = User::where('auto_mode', 1)->get();
        // foreach ($auto_mode_users as $auto_mode_user) {
        //     // twitterUserを呼び出す
        //     $twitter_user = $auto_mode_user->twitterUser;
        //     // dd($twitter_user);
        //     // アクセストークンを取得
        //     $token = $twitter_user->token;
        //     $token_secret = $twitter_user->tokenSecret;

        //     // twitter_idとscreen_nameを取得
        //     $twitter_id = $twitter_user->twitter_id;
        //     // dd($twitter_id);
        //     $screen_name = $twitter_user->nickname;
        //     // dd($screen_name);

        //     // APIに接続
        //     $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);
        //     // dd($connection);

        //     // フォローしている人のtwitter_idを取得
        //     $frinend_ids = $connection->get('friends/ids', array(
        //         'user_id' => $twitter_id,
        //         'screen_name' => $screen_name,
        //         'count' => 5000
        //     ));
        //     // dd($frinend_ids->ids);

        //     // まずは共通項を取得
        //     $common_terms = array_intersect($frinend_ids->ids, $follow_targets);
        //     // dd($common_terms);

        //     // 次にDB内accountとの差分を取得
        //     $diff = array_diff($follow_targets, $common_terms);
        //     // dd($diff);

        //     // 差分からランダムに１キー(screen_name)を取得する
        //     $follow_target_screen_name = array_rand($diff);
        //     $follow_target_id = $diff[$follow_target_screen_name];
        //     // dd($follow_target_id);

        //     $follow = $connection->post('friendships/create', array(
        //         'user_id' => $follow_target_id,
        //         'screen_name' => $follow_target_screen_name,
        //         'follow' => false
        //     ));

        //     dd($follow);
        // }






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
