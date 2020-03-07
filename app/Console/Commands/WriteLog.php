<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

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
        // logger()->info('This is WriteLog Command.');

        // ユーザー情報によって判定できるようにする
        // 基本はauto_mode 0 で停止状態

        // auto_modeが1のユーザーを取得
        // $auto_mode_user = User::where('auto_mode', 1)->get();
        $auto_mode_user = User::find(13);

        // dd($auto_mode_user);

        $auto_mode = $auto_mode_user->auto_mode;
        // dd($auto_mode);
        // auto_modeが0か1かで処理を変える

        if ($auto_mode === 1) {
            echo '自動フォローします' . "\n";
        } else {
            echo '自動フォロー機能停止中です' . "\n";
        }
    }
}
