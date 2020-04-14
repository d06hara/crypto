<?php

namespace App\Console\Commands;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Console\Command;
use App\Models\TwitterAccount;

class GetTwitterAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:twitteraccount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'getting twitter account';

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
        // ==========================
        // 仮想通貨関連アカウント取得処理
        // ==========================

        //  ユーザー認証(twitterOauth使用:ユーザーは自分)
        $config = config('twitter');
        $key = $config['api_key'];
        $secret_key = $config['secret_key'];
        $manager_token = $config['access_token'];
        $manager_token_secret = $config['access_token_secret'];

        $connection = new TwitterOAuth($key, $secret_key, $manager_token, $manager_token_secret);
        // ---------------------------

        // countの最大値20のときpageは1~51までしか選択できない
        // users/searchのレートリミットは900/15min

        // 1~51までの数字の配列を用意
        $array_num = range(1, 51);
        // シャッフルする
        shuffle($array_num);

        // アカウントを追加するための空の配列を用意
        $total_search_accounts = [];

        // 4page分の繰り返し処理
        for ($i = 1; $i < 5; $i++) {
            $search_accounts = $connection->get('users/search', array('q' => '仮想通貨', 'page' => $array_num[$i], 'count' => 20));
            // 取得したアカウントを配列に追加していく
            $total_search_accounts = array_merge($total_search_accounts, $search_accounts);
        }

        if (is_array($total_search_accounts)) {
            TwitterAccount::accountStore($total_search_accounts);
            logger()->info('アカウント保存処理完了');
        }
    }
}
