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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name'           => 'TEST' . $i,
                'email'          => 'test' . $i . '@test.com',
                'password'       => Hash::make('12345678'),
                'remember_token' => str_random(10),
                'created_at'     => now(),
                'twitter_id'     =>  $i,
                'updated_at'     => now(),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // $faker = Faker\Factory::create('ja_JP');
        // for ($i = 0; $i < 1000; $i++) {
        //     App\Models\User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         // 'address' => $faker->address,
        //     ]);
        // }
    }
}
