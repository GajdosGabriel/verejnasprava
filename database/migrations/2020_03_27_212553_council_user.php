<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CouncilUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('council_user', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('council_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('council_id')->references('id')->on('councils');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unique(['user_id', 'council_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('council_user');
    }
}
