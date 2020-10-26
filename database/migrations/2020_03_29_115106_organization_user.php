<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrganizationUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_user', function (Blueprint $table) {
            $table->integer('organization_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unique(['user_id', 'organization_id']);
        });


        \DB::table('organization_user')->insert([

            [
                'organization_id' => 1,
                'user_id' => 1,
            ],
            [
                'organization_id' => 1,
                'user_id' => 2,
            ],
            [
                'organization_id' => 1,
                'user_id' => 3,
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
        //
    }
}
