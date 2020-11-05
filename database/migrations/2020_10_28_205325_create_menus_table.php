<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25);
            $table->string('route', 15);
            $table->string('type', 15);
            $table->softDeletes();
        });

        \DB::table('menus')->insert([
            [
                'id' => 1,
                'name' => 'Zverejňovanie',
                'route' => 'post.index',
                'type' => 'horizontal',
            ],
            [
                'id' => 2,
                'name' => 'Kontakty',
                'route' => 'contact.index',
                'type' => 'horizontal',
            ],
            [
                'id' => 3,
                'name' => 'Zasadnutia',
                'route' => 'council.index',
                'type' => 'horizontal',
            ],
            [
                'id' => 4,
                'name' => 'Návrhy',
                'route' => 'item.index',
                'type' => 'horizontal',
            ],
            [
                'id' => 5,
                'name' => 'Objednávky',
                'route' => 'order.index',
                'type' => 'horizontal',
            ],
            [
                'id' => 6,
                'name' => 'Úlohy',
                'route' => 'tasks.index',
                'type' => 'horizontal',
            ],
            [
                'id' => 7,
                'name' => 'Podpora',
                'route' => 'supports.index',
                'type' => 'horizontal',
            ],
            [
                'id' => 8,
                'name' => 'Nastavenia',
                'route' => 'user.setup',
                'type' => 'vertical',
            ],
            [
                'id' => 9,
                'name' => 'Ľudia',
                'route' => 'user.index',
                'type' => 'vertical',
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
        Schema::dropIfExists('menus');
    }
}
