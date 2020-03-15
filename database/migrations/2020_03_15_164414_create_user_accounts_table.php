<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('twitter_user_id');
            $table->unsignedBigInteger('twitter_account_id');
            $table->primary(['twitter_user_id', 'twitter_account_id']);

            // 外部キー制約
            $table->foreign('twitter_user_id')
                ->references('id')
                ->on('twitter_users')
                ->onDelete('cascade');
            $table->foreign('twitter_account_id')
                ->references('id')
                ->on('twitter_accounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_accounts');
    }
}
