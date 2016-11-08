<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('billing_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->float('price_override')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('purchases', function (Blueprint $table) {
            $table->foreign('billing_id')->references('id')->on('billings');
            $table->foreign('product_id')->references('id')->on('products');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchases');
    }
}
