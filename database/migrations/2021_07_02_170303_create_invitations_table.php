<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('meeting_id')->unsigned()->index();
            $table->dateTime('send_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->softDeletes();

            $table->foreign('meeting_id')->references('id')->on('meetings');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unique(['user_id', 'meeting_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
