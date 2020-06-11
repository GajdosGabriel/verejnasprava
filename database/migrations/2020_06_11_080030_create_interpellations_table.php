<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterpellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interpellations', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('fileable_id')->index();
            $table->string('fileable_type');
            $table->string('name')->nullable();
            $table->text('body')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('interpellation')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['fileable_type', 'fileable_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interpellations');
    }
}
