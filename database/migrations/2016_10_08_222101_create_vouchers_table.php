<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('member_id')->unsigned(); // the member who authorized this
            $table->integer('member_account_id')->unsigned(); // the current account of the member who did this
            $table->text('remarks')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('vouchers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('member_account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vouchers');
    }
}
