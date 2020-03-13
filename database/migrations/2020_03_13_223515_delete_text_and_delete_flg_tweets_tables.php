<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTextAndDeleteFlgTweetsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweets', function (Blueprint $table) {

            // textとdelete_flgを削除
            $table->dropColumn('text');
            $table->dropColumn('delete_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tweets', function (Blueprint $table) {
            //textとdelete_flgを追加
            $table->string('text');
            $table->boolean('delete_flg');
        });
    }
}
