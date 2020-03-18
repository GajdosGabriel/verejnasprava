<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_number');
            $table->string('payment');
            $table->string('notes')->nullable();
            $table->dateTime('order_send')->nullable();
            $table->dateTime('confirmed')->nullable();
            $table->string('unique_hash')->nullable();
            $table->decimal('amount', 10, 2)->default('0.00');
            $table->date('due_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
//            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
//            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
