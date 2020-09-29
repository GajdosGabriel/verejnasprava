<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('email',100)->unique();
            $table->string('slug', 50)->nullable();
            $table->integer('active_organization')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('send_invitation')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        \DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'Gabriel',
                'last_name' => 'Gajdoš',
                'email' => 'gajdosgabo@gmail.com',
                'slug' => 'gajdos-gabriel',
                'active_organization' => 1,
                'password' => '$2y$10$Ngve.m4xLY2xOtUNPIdcxeOW/hsum/VWJsCFEkpV6uAtq.QGe2LQO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'first_name' => 'Ján',
                'last_name' => 'Novák',
                'email' => 'novak@gmail.com',
                'slug' => 'jan-novak',
                'active_organization' => 1,
                'password' => '$2y$10$Ngve.m4xLY2xOtUNPIdcxeOW/hsum/VWJsCFEkpV6uAtq.QGe2LQO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'first_name' => 'Peter',
                'last_name' => 'Vavrek',
                'email' => 'vavrek@gmail.com',
                'slug' => 'peter-vavrek',
                'active_organization' => 1,
                'password' => '$2y$10$Ngve.m4xLY2xOtUNPIdcxeOW/hsum/VWJsCFEkpV6uAtq.QGe2LQO',
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
        Schema::drop('users');
    }
}
