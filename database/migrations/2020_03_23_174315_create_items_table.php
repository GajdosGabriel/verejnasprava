<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('meeting_id')->unsigned()->index();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->boolean('vote_disabled')->default(1);
            $table->boolean('published')->default(0);
            $table->boolean('vote_type')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
