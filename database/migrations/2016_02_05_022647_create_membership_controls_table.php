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

            $table->integer('posted_by_account_id')->unsigned()->nullable()->comment = "The ID of the account who posted this club share listing.";
            $table->integer('current_account_id')->unsigned()->nullable()->comment = "The ID of the account who is currently holding this listing. New club share listings set this to NULL, which means this listing is not yet sold.";
            $table->integer('membership_slot_id')->unsigned()->nullable()->comment = "This is the membership slot being sold or transfered.";
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
