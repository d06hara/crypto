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
use Illuminate\Support\Carbon;
use App\Models\Tweet;

use function GuzzleHttp\json_decode;

class TestController extends Controller
{
    // テストメソッド
    public function test()
    {
        $user = auth()->user()->twitterUser;
        dd($user);
        dd($user->token);
        // dd($user->user_id);
        // $user->accounts()->attach(458);
        // dd($user);

        $accounts = TwitterAccount::with('users')->where('id', 458)->get();
        // dd($accounts);
        // $accounts = TwitterAccount::with('users')->inRandomOrder()->take(50)->get();
        $accounts = $accounts->toArray();
        // dd($accounts);
        $a = $accounts[0]['users'];
        // dd($a);
        $b = $a[0]['user_id'];
        // dd($a);
        // dd($b);
        foreach ($accounts as $key => &$value) {
            if (empty($value['users'])) {
                $value['users'] = false;
                dd('false');
            } else {
                // dd($value['users']);
                // dd(count($value['users']));
                // dd('からではない');
                // dd($value['users'][0]['user_id']);

                $i = 0;
                while ($i < count($value['users'])) {

                    if ($value['users'][$i]['user_id'] === 3) {
                        // dd('2?');
                        $value['users'] = true;
                        break;
                    }
                    // dd('１ではない');
                    $i++;
                }
                // dd($value['users']);
                if (is_array($value['users'])) {
                    // dd('false?');
                    $value['users'] = false;
                }
            };
        };
        dd($accounts);

        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];
        $access_token = $config['access_token'];
        $access_key = $config['access_token_secret'];
        $connection = new TwitterOAuth($key, $secret_key, $access_token, $access_key);
        // $frinend_ids = $connection->get('friends/ids', array(
        //     'user_id' => $twitter_id,
        //     'screen_name' => $screen_name,
        //     'count' => 5000
        // ));
        // dd($frinend_ids->ids);

        // twitter_accountsテーブルからidとscreen_nameを抜き出す
        $follow_targets = DB::table('twitter_accounts')->pluck('twitter_id', 'screen_name');
        // 配列へ変換
        $follow_targets = $follow_targets->toArray();
        $ids = [];
        $cursor = -1;
        do {
            $result = $connection->get("friends/ids", [
                'cursor' => $cursor
            ]);
            if (!is_array($result->ids)) {
                throw new \Exception;
            }
            foreach ($result->ids as $id) {
                $ids[] = $id;
            }
            $cursor = $result->next_cursor;
        } while ($cursor != 0);

        // dd($ids);

        $common = array_intersect($ids, $follow_targets);
        // dd($common);

        $diff = array_diff($follow_targets, $common);
        // dd($diff);
        $follow_target_screen_name = array_rand($diff);
        // dd($follow_target_screen_name);
        $follow_target_id = $diff[$follow_target_screen_name];
        dd($follow_target_id);




        $array1 = [1, 2, 3];
        $array2 = [1, 2];
        $common = array_intersect($array2, $array1);
        // dd($common);
        $diff = array_diff($array1, $common);
        // dd($diff);
        if (!empty($diff)) {
            dd('a');
        };
        dd('i');


        // 現時刻
        $a = TwitterUser::where('twitter_id', 1)->first();
        if (!is_null($a)) {
            dd('ok');
        }
        dd($a);

        $time = Carbon::now();
        $yesterday = Carbon::now()->subDay(1);

        // 8日前を取得

        $before_eight_days = Carbon::now()->subDay(8);
        // $null = Tweet::where('created_at', null)->delete();
        $null = Tweet::where('created_at', null)->count();
        // dd($null);

        // $tweet = Tweet::where('created_at', '<', $before_eight_days)->delete();
        $tweet = Tweet::where('created_at', '<', $yesterday)->count();
        dd($tweet);

        if ($time < $before_eight_days) {
            dd('a');
        }

        dd($before_eight_days);

        dd($time);

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
