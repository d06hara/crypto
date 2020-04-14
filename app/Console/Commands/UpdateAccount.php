<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;
use App\Models\TwitterAccount;

class UpdateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update db twitter account';

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
        /**
         * twitterアカウント更新処理
         */
        // 更新日が前日以前のアカウントを全て取得
        $today = Carbon::today();
        $total_update_accounts = TwitterAccount::where('updated_at', '<=', $today)->get()->toArray();

        // アカウントがある場合更新処理を行う
        if (!empty($total_update_accounts)) {
            // 取得した配列の数を取得
            $accounts_count = count($total_update_accounts);

            //  ユーザー認証(twitterOauth使用:ユーザーは自分)
            $config = config('twitter');
            $key = $config['api_key'];
            $secret_key = $config['secret_key'];
            $manager_token = $config['access_token'];
            $manager_token_secret = $config['access_token_secret'];

            $connection = new TwitterOAuth($key, $secret_key, $manager_token, $manager_token_secret);

            // 更新対象の数が100を超えていた場合
            if ($accounts_count > 100) {

                // １度に更新できる上限の100要素取り出す
                $update_accounts = array_slice($total_update_accounts, 0, 100);

                for ($i = 0; $i < 100; $i++) {
                    // twitter_idとscreen_nameを取得
                    $update_accounts_twitter_id = $update_accounts[$i]['twitter_id'];
                    $update_accounts_twitter_screen_name = $update_accounts[$i]['screen_name'];
                    // ユーザーを検索
                    $update_accounts_info = $connection->get('users/show', array(
                        'user_id' => $update_accounts_twitter_id,
                        'screen_name' => $update_accounts_twitter_screen_name,
                    ));
                    // アカウント情報が取得できたら更新処理を行う
                    // 凍結等でエラーになる場合、更新処理は行わずそのまま
                    if (empty($update_accounts_info->errors)) {
                        // DBから更新するアカウントの情報を取得
                        $db_account = TwitterAccount::where('twitter_id', $update_accounts_twitter_id)->first();
                        // 取得した情報のstatusの有無で処理を分ける
                        if (empty($update_accounts_info->status)) {
                            // statusが無い場合、textデータ以外を更新
                            $db_account->name = $update_accounts_info->name;
                            $db_account->screen_name = $update_accounts_info->screen_name;
                            $db_account->description = $update_accounts_info->description;
                            $db_account->followers_count = $update_accounts_info->followers_count;
                            $db_account->friends_count = $update_accounts_info->friends_count;
                            // updated_atを更新
                            $db_account->updated_at = Carbon::now();

                            $db_account->save();
                        } else {
                            // statusがある場合,textデータも含めて更新
                            $db_account->name = $update_accounts_info->name;
                            $db_account->screen_name = $update_accounts_info->screen_name;
                            $db_account->description = $update_accounts_info->description;
                            $db_account->followers_count = $update_accounts_info->followers_count;
                            $db_account->friends_count = $update_accounts_info->friends_count;
                            $db_account->text = $update_accounts_info->status->text;
                            // updated_atを更新
                            $db_account->updated_at = Carbon::now();

                            $db_account->save();
                        }
                    }
                }
            } else {
                // 数が100未満の場合
                for ($i = 0; $i < $accounts_count; $i++) {
                    // twitter_idとscreen_nameを取得
                    $update_accounts_twitter_id = $total_update_accounts[$i]['twitter_id'];
                    $update_accounts_twitter_screen_name = $total_update_accounts[$i]['screen_name'];
                    $update_accounts_info = $connection->get('users/show', array(
                        'user_id' => $update_accounts_twitter_id,
                        'screen_name' => $update_accounts_twitter_screen_name,
                    ));
                    // アカウント情報が取得できたら更新処理を行う
                    // 凍結等でエラーになる場合、更新処理は行わずそのまま
                    if (empty($update_accounts_info->errors)) {
                        // DBから更新するアカウントの情報を取得
                        $db_account = TwitterAccount::where('twitter_id', $update_accounts_twitter_id)->first();

                        // 取得した情報のstatusの有無で処理を分ける
                        if (empty($update_accounts_info->status)) {
                            // statusが無い場合、textデータ以外を更新
                            $db_account->name = $update_accounts_info->name;
                            $db_account->screen_name = $update_accounts_info->screen_name;
                            $db_account->description = $update_accounts_info->description;
                            $db_account->followers_count = $update_accounts_info->followers_count;
                            $db_account->friends_count = $update_accounts_info->friends_count;
                            // updated_atを更新
                            $db_account->updated_at = Carbon::now();

                            $db_account->save();
                        } else {
                            // statusがある場合,textデータも含めて更新
                            $db_account->name = $update_accounts_info->name;
                            $db_account->screen_name = $update_accounts_info->screen_name;
                            $db_account->description = $update_accounts_info->description;
                            $db_account->followers_count = $update_accounts_info->followers_count;
                            $db_account->friends_count = $update_accounts_info->friends_count;
                            $db_account->text = $update_accounts_info->status->text;
                            // updated_atを更新
                            $db_account->updated_at = Carbon::now();

                            $db_account->save();
                        }
                    }
                }
            }
        }

        logger()->info('アカウント更新処理完了');
    }
}
