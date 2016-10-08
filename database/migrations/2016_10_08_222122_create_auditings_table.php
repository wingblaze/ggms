<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model_name')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('category');
            $table->string('action');
            $table->string('label')->nullable();
            $table->integer('value')->nullable();
            $table->timestamps();

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
        Schema::drop('auditings');
    }
}
