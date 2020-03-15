<?php

use Illuminate\Database\Seeder;
use App\Models\UserAccount;

class UserAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            UserAccount::create([
                'twitter_user_id' => 3,
                'twitter_account_id' => $i
            ]);
        }
    }
}
