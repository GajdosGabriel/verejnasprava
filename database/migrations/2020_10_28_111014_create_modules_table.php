<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25);
            $table->string('type', 10);
            $table->timestamps();
        });

        \DB::table('modules')->insert([
            [
                'id' => 1,
                'name' => 'post',
                'type' => '',
            ],
            [
                'id' => 2,
                'name' => 'contact',
                'type' => '',
            ],
            [
                'id' => 3,
                'name' => 'order',
                'type' => '',
            ],
            [
                'id' => 4,
                'name' => 'task',
                'type' => '',
            ],
            [
                'id' => 5,
                'name' => 'support',
                'type' => '',
            ]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
