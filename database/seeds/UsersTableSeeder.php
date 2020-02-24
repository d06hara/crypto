<?php

use Illuminate\Database\Seeder;

// userモデルを追加
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name'           => 'TEST' . $i,
                'email'          => 'test' . $i . '@test.com',
                'password'       => Hash::make('12345678'),
                'remember_token' => str_random(10),
                'created_at'     => now(),
                'twitter_id'     =>  $i,
                'updated_at'     => now(),
                'delete_flg'     => 1,
            ]);
        }
    }
}
