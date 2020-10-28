<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_organization', function (Blueprint $table) {
            $table->integer('organization_id')->unsigned()->index();
            $table->integer('menu_id')->unsigned()->index();

            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->unique(['menu_id', 'organization_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_organization');
    }
}
