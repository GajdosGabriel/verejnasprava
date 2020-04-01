<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CouncilOrganization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('council_organization', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('council_id')->unsigned()->index();
            $table->integer('organization_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('council_id')->references('id')->on('councils');
            $table->foreign('organization_id')->references('id')->on('organizations');

            $table->unique(['organization_id', 'council_id']);
        });
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
