<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function($table) {
            $table->foreign('resource_id')->references('id')->on('resources');
        });

        Schema::table('rent_resources', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('resource_id')->references('id')->on('resources');
        });

        Schema::table('complaints', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('users', function($table) {
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('membership_slots', function($table) {
            $table->foreign('membership_control_id')->references('id')->on('membership_controls');
        });

        Schema::table('membership_controls', function($table) {
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('membership_slot_id')->references('id')->on('membership_slots');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
