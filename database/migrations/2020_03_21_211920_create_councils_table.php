<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouncilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('councils', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('organization_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->unsignedInteger('min_user')->nullable();
            $table->unsignedInteger('approved')->nullable();
            $table->unsignedInteger('quorate')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });

        \DB::table('councils')->insert([
            [
                'id' => 1,
                'organization_id' => 1,
                'name' => 'Obecné zastupiteľstvo',
                'slug' => 'obecne-zastupitelstvo',
                'description' => 'Obecné zastupiteľstvo 2019-2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('councils');
    }
}
