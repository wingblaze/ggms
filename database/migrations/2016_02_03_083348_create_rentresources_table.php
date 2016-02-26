<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentresourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_resources', function (Blueprint $table) {
            $table->increments('id');
            
            // Has user_id attribute, foreign key on users
            $table->integer('user_id')->unsigned()->onDelete('cascade');

            // Has resource_id attribute, foreign key on resource
            $table->integer('resource_id')->unsigned()->onDelete('cascade');
            

            $table->dateTime('start_time');
            $table->dateTime('end_time');

            $table->string('status', 40)->default("Available");

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
        Schema::drop('rent_resources');
    }
}
