<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('fileable_id')->index();
            $table->string('fileable_type');
            $table->string('name')->nullable();
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();

//            $table->unique(['fileable_type', 'fileable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
