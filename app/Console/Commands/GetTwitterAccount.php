<?php

namespace App\Console\Commands;

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
        // 仮想通貨に関するユーザーを取得し保存する処理

        // ユーザー認証(twitterOauth使用:ユーザーは自分)
        // ---------------------------
        $total_search_accounts = [];

        // とりあえず4ページ分(80account)
        for ($i = 1; $i < 2; $i++) {
            $search_accounts = \Twitter::get('users/search', array('q' => '仮想通貨', 'page' => $i));
            $total_search_accounts = array_merge($total_search_accounts, $search_accounts);
        };

        TwitterAccount::accountStore($total_search_accounts);
    }
}
