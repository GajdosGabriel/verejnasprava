<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->unsignedInteger('fileable_id')->index();
            $table->unsignedInteger('user_id');
            $table->string('fileable_type');
            $table->string('filename');
            $table->string('path');
            $table->string('org_name');
            $table->string('mime',10)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['fileable_type', 'fileable_id', 'path']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
