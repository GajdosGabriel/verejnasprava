<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->integer('organization_id')->unsigned();
            $table->string('slug',200);
            $table->string('name', 200);
            $table->string('email',100)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('psc', 6)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('web', 50)->nullable();
            $table->string('ico', 12)->nullable();
            $table->string('dic', 20)->nullable();
            $table->string('ic_dic', 20)->nullable();
            $table->string('bank_name', 50)->nullable();
            $table->string('bank_number', 50)->nullable();
            $table->string('bank_iban', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');

        });

        \DB::table('contacts')->insert([
            [
                'id' => 1,
                'organization_id' => 1,
                'name' => 'Reprezent',
                'slug' => 'reprezent',
                'street' => 'Sibírska 23',
                'city' => 'Prešov',
                'psc' => '08641',
                'phone' => '0905320616',
                'email' => 'reprezent@reprezent.com',
                'ico' => 154777,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'organization_id' => 1,
                'name' => 'Telemont',
                'slug' => 'telemont',
                'street' => 'Východná 3',
                'city' => 'Košice',
                'psc' => '91108',
                'phone' => '0903777 8888',
                'email' => 'telemont@info.com',
                'ico' => 19954777,
                'created_at' => now(),
                'updated_at' => now(),
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
        Schema::dropIfExists('contacts');
    }
}
