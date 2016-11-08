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
            $table->string('status')->default('unpaid');
            $table->string('model_name')->nullable(); // -- ref to asset, maybe? or to rental
            $table->string('model_id')->nullable();

            $table->integer('terminal_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
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
