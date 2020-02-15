<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tweet_id')->nullable()->comment('ツイートID');
            $table->string('text')->nullable()->comment('ツイート内容');
            $table->dateTime('tweet_created_at')->nullable()->comment('ツイート日時');
            $table->string('screen_name')->nullable()->comment('@スクリーンネーム');
            $table->string('user_name')->nullable()->comment('ユーザー名');
            $table->integer('bland_id')->nullable();
            $table->boolean('delete_flg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
