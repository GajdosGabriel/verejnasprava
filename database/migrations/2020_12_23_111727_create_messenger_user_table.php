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
            $table->timestamp('opened')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('messenger_id')->references('id')->on('messengers')->onDelete('cascade')->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();

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
