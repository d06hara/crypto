<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('twetter_id')->comment('ツイッターid');
            $table->string('name')->nullable();
            $table->string('screen_name')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('followers_count');
            $table->bigInteger('friends_count');
            $table->string('text')->nullable();
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
        Schema::dropIfExists('twitter_accounts');
    }
}
