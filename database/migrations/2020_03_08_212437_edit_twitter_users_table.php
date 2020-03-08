<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTwitterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('twitter_users', function (Blueprint $table) {
            //twitter_idにカラム名変更
            $table->renameColumn('provider_user_id', 'twitter_id');
            // カラムを追加
            $table->string('token');
            $table->string('tokenSecret');
            $table->string('nickname');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('twitter_users', function (Blueprint $table) {
            //変更したカラム名を戻す
            $table->renameColumn('twitter_id', 'provider_user_id');
            // 追加したカラムを削除
            $table->dropColumn('token');
            $table->dropColumn('tokenSecret');
            $table->dropColumn('nickname');
            $table->dropColumn('name');
        });
    }
}
