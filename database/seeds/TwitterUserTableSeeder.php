<?php

use Illuminate\Database\Seeder;

class TwitterUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('twitter_users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
