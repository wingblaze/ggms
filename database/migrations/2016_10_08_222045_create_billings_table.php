<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            
            $table->text('description')->nullable();
            $table->string('title');
            $table->string('model_name')->nullable(); // -- ref to asset, maybe? or to rental
            $table->string('model_id')->nullable();
            $table->float('amount');

            $table->integer('terminal_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('terminal_id')->references('id')->on('terminals');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('billings');
    }
}
