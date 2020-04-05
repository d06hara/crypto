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
            'id' => 1,
            'bland_name' => 'ビットコイン',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 2,
            'bland_name' => 'イーサリアム',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 3,
            'bland_name' => 'イーサリアムクラシック',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 4,
            'bland_name' => 'リスク',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 5,
            'bland_name' => 'ファクトム',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 6,
            'bland_name' => 'リップル',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 7,
            'bland_name' => 'ネム',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 8,
            'bland_name' => 'ライトコイン',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 9,
            'bland_name' => 'ビットコインキャッシュ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 10,
            'bland_name' => 'モナコイン',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 11,
            'bland_name' => 'ステラルーメン',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);

        $param = [
            'id' => 12,
            'bland_name' => 'クアンタム',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('blands')->insert($param);
    }
}
