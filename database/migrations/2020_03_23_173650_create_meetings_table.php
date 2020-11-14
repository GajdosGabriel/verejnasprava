<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('council_id')->unsigned()->index();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->char('locality', 200)->nullable();
            $table->dateTime('start_at')->nullable();
            $table->boolean('published')->default(0);
            $table->timestamp('notification')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('council_id')->references('id')->on('councils')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
