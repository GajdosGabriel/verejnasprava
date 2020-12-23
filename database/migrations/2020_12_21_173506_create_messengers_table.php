<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messengers', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('requested_user')->unsigned();
            $table->string('name')->nullable();
            $table->text('body');
            $table->enum('type', ['message', 'free']);
            $table->timestamp('opened')->nullable();
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
        Schema::dropIfExists('messengers');
    }
}
