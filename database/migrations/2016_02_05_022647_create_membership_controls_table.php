<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_controls', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('posted_by_account_id')->unsigned()->nullable();
            $table->integer('current_account_id')->unsigned()->nullable();
            $table->integer('membership_slot_id')->unsigned()->nullable();
            $table->unique( array('current_account_id','membership_slot_id') );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('membership_controls');
    }
}
