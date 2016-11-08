<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('billings', function ($table) {
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('terminals');
    }
}
