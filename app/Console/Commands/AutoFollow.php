<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\TwitterAccount;

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
        // ===================
        // 自動フォロー処理
        // ===================

        // auto_modeが1になっているユーザーを取得
        $auto_mode_users = User::where('auto_mode', 1)->get();

        if ($auto_mode_users->isEmpty()) {
            // auto_modeが1のユーザーがいなければ処理終了
            logger()->info('自動フォロー機能停止中です');
        } else {
            // auto_modeが1のユーザーがいる場合、フォロー処理を実行
            logger()->info('自動フォローします');

            // 前日の日時を取得
            $yesterday = Carbon::yesterday();
            // twitter_accountsテーブルからidとscreen_nameを抜き出す
            // 更新日が昨日より前のアカウントは取得しない
            $follow_targets = TwitterAccount::where('updated_at', '>=', $yesterday)->pluck('twitter_id', 'screen_name');
            // 配列へ変換
            $follow_targets = $follow_targets->toArray();
            // アクセスキーを取得
            $config = config('twitter');
            $key = $config['api_key'];
            $secret_key = $config['secret_key'];

            // 順にフォロー処理
            foreach ($auto_mode_users as $auto_mode_user) {
                // twitterUserを呼び出す
                $twitter_user = $auto_mode_user->twitterUser;
                // アクセストークンを取得
                $token = $twitter_user->token;
                $token_secret = $twitter_user->tokenSecret;

                // 接続
                $connection = new TwitterOAuth($key, $secret_key, $token, $token_secret);
                // フォロワーのtwitter_idを全て取得
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

                // まずは共通項を取得
                $common_terms = array_intersect($ids, $follow_targets);

                // 次にDB内accountとの差分を取得
                $diff = array_diff($follow_targets, $common_terms);

                // 差分がある場合はフォロー処理へ
                // 差分が無い場合処理終了
                if (!empty($diff)) {
                    // 差分からランダムに１キー(screen_name)を取得する
                    $follow_target_screen_name = array_rand($diff);
                    $follow_target_id = $diff[$follow_target_screen_name];

                    $follow = $connection->post('friendships/create', array(
                        'user_id' => $follow_target_id,
                        'screen_name' => $follow_target_screen_name,
                        'follow' => false
                    ));
                    // リレーションへの記入処理;
                    $follow_target_db_id = TwitterAccount::where('twitter_id', $follow_target_id)->value('id');
                    $twitter_user->accounts()->attach($follow_target_db_id);
                }
            }
            logger()->info('自動フォロー完了');
        }
    }
}
