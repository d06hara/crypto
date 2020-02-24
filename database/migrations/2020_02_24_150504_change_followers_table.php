<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('followers', function (Blueprint $table) {
            //データ型の変更
            $table->unsignedBigInteger('following_id')->change();
            $table->unsignedBigInteger('followed_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('followers', function (Blueprint $table) {
            //
            $table->unsignedInteger('following_id')->change();
            $table->unsignedInteger('followed_id')->change();
        });
    }
}
