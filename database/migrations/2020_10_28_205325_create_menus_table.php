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
            $table->string('route', 20);
            $table->string('url', 25);
            $table->string('type', 15);
            $table->softDeletes();
        });

        \DB::table('menus')->insert([
            [
                'id' => 1,
                'name' => 'Zverejňovanie',
                'route' => 'posts.index',
                'url' => '/posts',
                'type' => 'horizontal',
            ],
            [
                'id' => 2,
                'name' => 'Kontakty',
                'route' => 'contact.index',
                'url' => '/contacts',
                'type' => 'horizontal',
            ],
            [
                'id' => 3,
                'name' => 'Zastupiteľstvá',
                'route' => 'council.index',
                'url' => '/zastupitelstva',
                'type' => 'horizontal',
            ],
            [
                'id' => 4,
                'name' => 'Návrhy',
                'route' => 'items.index',
                'url' => '/items',
                'type' => 'horizontal',
            ],
            [
                'id' => 5,
                'name' => 'Objednávky',
                'route' => 'order.index',
                'url' => '',
                'type' => 'horizontal',
            ],
            [
                'id' => 6,
                'name' => 'Úlohy',
                'route' => 'tasks.index',
                'url' => '/tasts',
                'type' => 'horizontal',
            ],
            [
                'id' => 7,
                'name' => 'Podpora',
                'route' => 'supports.index',
                'url' => '/supports',
                'type' => 'horizontal',
            ],
            [
                'id' => 8,
                'name' => 'Nastavenia',
                'route' => 'user.setup',
                'url' => '/user/users/setup',
                'type' => 'vertical',
            ],
            [
                'id' => 9,
                'name' => 'Ľudia',
                'route' => 'users.index',
                'url' => '/users',
                'type' => 'vertical',
            ],
            [
                'id' => 10,
                'name' => 'Správy',
                'route' => 'messengers.index',
                'url' => '/messengers',
                'type' => 'horizontal',
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
