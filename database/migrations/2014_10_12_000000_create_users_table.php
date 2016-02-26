<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('mobile_number')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('nationality')->nullable();

            $table->enum('gender', array('male', 'female'));
            $table->string('salutation')->nullable();

            $table->string('password', 60);

            $table->string('civil_status')->nullable();
            $table->integer('account_id')->unsigned()->nullable();
            $table->enum('account_type', array('owner', 'dependent'))->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
