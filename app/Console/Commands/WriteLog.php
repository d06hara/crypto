<?php

namespace App\Console\Commands;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\TwitterAccount;
use Illuminate\Support\Facades\DB;

class WriteLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'writelog:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'write info messages in log file';

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

        // アクセスキーを取得
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];

        // DBに保存されているaccountsの全てのtwitter_idを取得し配列に変換
        $accounts_twitter_id = DB::table('twitter_accounts')->pluck('twitter_id');
        $accounts_twitter_id = json_decode($accounts_twitter_id);

        // auto_modeが1のユーザーを取得
        $auto_mode_users = User::where('auto_mode', 1)->get();

        // auto_modeが１のユーザーがいるか判定
        if ($auto_mode_users->isEmpty()) {
            echo '自動フォロー機能停止中です' . "\n";
        } else {
            echo '自動フォローします' . "\n";
            foreach ($auto_mode_users as $auto_mode_user) {
                // twitterUserを呼び出す
                $twitter_user = $auto_mode_user->twitterUser;
                // アクセストークンを取得
                $token = $twitter_user->token;
                $token_secret = $twitter_user->tokenSecret;

                // APIに接続
                $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);

                // フォローしている人のtwitter_idを取得
                $frinend_ids = $connection->get('friends/ids');

                // まずは共通項を取得
                $common_terms = array_intersect($frinend_ids->ids, $accounts_twitter_id);

                // 次にDB内accountとの差分を取得
                $diff = array_diff($accounts_twitter_id, $common_terms);

                // 差分からランダムに１つidを取得する
                $follow_id = $diff[array_rand($diff)];

                $follow = $connection->post('friendships/create', array('user_id' => $follow_id));
            }
        }
        // $twitter_users = $auto_mode_users->twitterUser->get();
        // dd($auto_mode_users);

        // $auto_mode = $auto_mode_users->auto_mode;
        // // dd($auto_mode);
        // // auto_modeが0か1かで処理を変える

        // if ($auto_mode === 1) {
        //     // echo '自動フォローします' . "\n";
        //     // logger()->info('自動フォローします');


        //     // 自分がフォローしている人のtwitter_idを取得
        //     $friends_id = \Twitter::get('friends/ids');

        //     // DBに保存されているaccountsの全てのtwitter_idを取得し配列に変換
        //     $accounts_twitter_id = DB::table('twitter_accounts')->pluck('twitter_id');
        //     $accounts_twitter_id = json_decode($accounts_twitter_id);

        //     // まずは共通項を取得
        //     $common_terms = array_intersect($friends_id->ids, $accounts_twitter_id);

        //     // dd($common_terms);

        //     // 次にDB内accountとの差分を取得
        //     $diff = array_diff($accounts_twitter_id, $common_terms);

        //     // 差分からランダムに１つidを取得する
        //     $follow_id = $diff[array_rand($diff)];

        //     $follow = \Twitter::post('friendships/create', array('user_id' => $follow_id));

        //     dd($follow);
        // } else {
        //     // echo '自動フォロー機能停止中です' . "\n";
        //     logger()->info('自動フォロー機能停止中です');
        // }
    }
}
