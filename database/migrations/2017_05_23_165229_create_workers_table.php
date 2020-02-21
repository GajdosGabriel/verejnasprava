<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organization_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->length(100)->unique();
            $table->string('slug')->length(50)->nullable();
            $table->string('position')->length(200)->nullable();
            $table->string('street')->length(100)->nullable();
            $table->string('city')->length(50)->nullable();
            $table->integer('psc')->length(6)->nullable();
            $table->string('phone')->length(50)->nullable();
            $table->date('date_born')->nullable();
            $table->date('date_contract')->nullable();
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
        Schema::dropIfExists('workers');
    }
}
