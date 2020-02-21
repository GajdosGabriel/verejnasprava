<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('slug', 60);
            $table->softDeletes();
        });

        \DB::table('categories')->insert([
            [
                'name' => 'Faktúry',
                'slug' => 'faktury',
            ],

            [
                'name' => 'Objednávky',
                'slug' => 'objednavky',
            ],
            [
                'name' => 'Vzn',
                'slug' => 'vzn',
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
        Schema::dropIfExists('categories');
    }
}
