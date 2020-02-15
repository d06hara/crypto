<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'bland_name' => 'ビットコインキャッシュ',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
        $param = [
            'bland_name' => 'イーサリアム',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
        $param = [
            'bland_name' => 'イーサリアムクラシック',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
        $param = [
            'bland_name' => 'リップル',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
        $param = [
            'bland_name' => 'ライトコイン',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
        $param = [
            'bland_name' => 'ネム',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
        $param = [
            'bland_name' => 'モナコイン',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
        $param = [
            'bland_name' => 'リスク',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
        $param = [
            'bland_name' => 'ファクトム',
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
    }
}
