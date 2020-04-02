<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Abraham\TwitterOAuth\TwitterOAuth;

class AutoFollow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:follow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'twitter account auto follow mode';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // TODO

        // 差分がない場合の処理

        // ユーザー情報によって判定できるようにする
        // 基本はauto_mode 0 で停止状態

        $follow_targets = DB::table('twitter_accounts')->pluck('twitter_id', 'screen_name');
        // $follow_targets = TwitterAccount::get('twitter_id');
        // $follow_targets = json_decode($follow_targets);
        $follow_targets = $follow_targets->toArray();
        // dd($follow_targets->toArray());
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        $auto_mode_users = User::where('auto_mode', 1)->get();

        // auto_modeが１のユーザーがいるか判定
        if ($auto_mode_users->isEmpty()) {
            logger()->info('自動フォロー機能停止中です');
        } else {
            logger()->info('自動フォローします');

            foreach ($auto_mode_users as $auto_mode_user) {
                // twitterUserを呼び出す
                $twitter_user = $auto_mode_user->twitterUser;
                // dd($twitter_user);
                // アクセストークンを取得
                $token = $twitter_user->token;
                $token_secret = $twitter_user->tokenSecret;

                // twitter_idとscreen_nameを取得
                $twitter_id = $twitter_user->twitter_id;
                // dd($twitter_id);
                $screen_name = $twitter_user->nickname;
                // dd($screen_name);

                // APIに接続
                $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);
                // dd($connection);

                // フォローしている人のtwitter_idを取得
                $frinend_ids = $connection->get('friends/ids', array(
                    'user_id' => $twitter_id,
                    'screen_name' => $screen_name,
                    'count' => 5000
                ));
                // dd($frinend_ids->ids);

                // まずは共通項を取得
                $common_terms = array_intersect($frinend_ids->ids, $follow_targets);
                // dd($common_terms);

                // 次にDB内accountとの差分を取得
                $diff = array_diff($follow_targets, $common_terms);
                // dd($diff);

                // 差分がある場合はフォロー処理へ
                // 差分が無い場合処理終了
                if (!empty($diff)) {
                    // 差分からランダムに１キー(screen_name)を取得する
                    $follow_target_screen_name = array_rand($diff);
                    $follow_target_id = $diff[$follow_target_screen_name];
                    // dd($follow_target_id);

                    $follow = $connection->post('friendships/create', array(
                        'user_id' => $follow_target_id,
                        'screen_name' => $follow_target_screen_name,
                        'follow' => false
                    ));
                }
            }
            logger()->info('自動フォロー完了');
        }
    }
}
