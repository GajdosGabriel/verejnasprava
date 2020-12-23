<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengerUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messenger_user', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('messenger_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('messenger_id')->references('id')->on('messengers');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unique(['user_id', 'messenger_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messenger_user');
    }
}
