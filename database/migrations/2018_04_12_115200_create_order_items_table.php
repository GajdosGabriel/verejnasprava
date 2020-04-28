<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->unsignedInteger('order_id');
            $table->text('name');
            $table->decimal('price_with_vat', 10, 2)->nullable();
            $table->decimal('price_total', 10, 2)->nullable();
            $table->integer('vat');
            $table->integer('quantity')->nullable();
            $table->string('unique_hash')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
