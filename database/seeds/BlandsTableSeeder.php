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
        //データのクリア
        DB::table('blands')->truncate();

        // データ挿入
        $param = [
            'bland_name' => 'ビットコイン',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'イーサリアム',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'イーサリアムクラシック',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'リスク',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'ファクトム',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'リップル',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'ネム',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'ライトコイン',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'ビットコインキャッシュ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'モナコイン',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'ステラルーメン',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'bland_name' => 'クアンタム',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
    }
}
