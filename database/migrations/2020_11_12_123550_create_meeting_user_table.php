<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('meeting_id')->unsigned()->index();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('meeting_id')->references('id')->on('meetings');
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
        Schema::dropIfExists('meeting_user');
    }
}
