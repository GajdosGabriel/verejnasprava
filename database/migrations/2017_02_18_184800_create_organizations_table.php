<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->integer('user_id')->unsigned();
            $table->string('slug',250);
            $table->string('name', 250);
            $table->string('email',100)->unique();
            $table->string('street', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('psc', 6)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('web', 50)->nullable();
            $table->string('ico', 12)->unique();
            $table->string('dic', 20)->nullable();
            $table->string('ic_dic', 20)->nullable();
            $table->string('bank_name', 50)->nullable();
            $table->string('bank_number', 50)->nullable();
            $table->string('bank_iban', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        \DB::table('organizations')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'name' => 'Reprezent',
                'slug' => 'reprezent',
                'email' => 'asfdasdfas@reprezent.com',
                'ico' => 187854777,
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
        Schema::dropIfExists('organizations');
    }
}
