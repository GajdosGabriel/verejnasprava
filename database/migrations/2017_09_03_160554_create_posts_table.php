<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('int_number', 30)->nullable();
            $table->string('slug')->nullable();
            $table->string('number_invoice')->nullable();
            $table->decimal('price',10,2);
            $table->date('date_in');
            $table->integer('organization_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('organization_id')
//                ->references('id')->on('organizations')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
