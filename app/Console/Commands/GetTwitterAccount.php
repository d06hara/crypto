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
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // 練習として10ユーザー分取得
        $search_accounts = \Twitter::get('users/search', array('q' => '仮想通貨', 'count' => 10, 'since_id' => 1000000000));
    }
}
