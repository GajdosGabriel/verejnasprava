<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_organization', function (Blueprint $table) {
            $table->integer('organization_id')->unsigned()->index();
            $table->integer('module_id')->unsigned()->index();

            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->unique(['module_id', 'organization_id']);
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
        Schema::dropIfExists('module_organization');
    }
}
