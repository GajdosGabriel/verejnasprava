<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_meeting', function (Blueprint $table) {
            $table->integer('item_id')->unsigned()->index();
            $table->integer('meeting_id')->unsigned()->index();
            $table->integer('order')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('meeting_id')->references('id')->on('meetings');

            $table->unique(['item_id', 'meeting_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_meeting');
    }
}
