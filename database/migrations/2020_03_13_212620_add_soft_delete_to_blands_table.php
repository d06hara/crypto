<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToBlandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blands', function (Blueprint $table) {
            //delete_flgを削除
            $table->dropColumn('delete_flg');

            // 論理削除を有効にする
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blands', function (Blueprint $table) {
            //delete_flgを追加
            $table->boolean('detete_flg');
        });
    }
}
