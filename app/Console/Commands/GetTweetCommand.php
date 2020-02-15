<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Tweets;

class GetTweetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'getting tweet';

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
        //cronで実行したい処理を記述
    }
}
