<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('tin_number');
            $table->string('home_address')->nullable();
            $table->string('business_address')->nullable();
            

            $table->string('bank_account')->nullable();
            $table->string('credit_card_number')->nullable();

            $table->integer('group_id')->unsigned()->nullable();

            $table->string('residence_certificate_id');
            $table->string('residence_certificate_place_issued');
            $table->date('residence_certificate_date_issued');

            $table->date('expiration');

            $table->string('address', 100);

            $table->string('phone', 30);
            $table->string('fax', 30)->nullable();
            $table->string('email', 30)->nullable()->unique();

            $table->date('date_approved')->nullable();
            $table->enum('status', array('On Review', 'Inactive', 'Active', 'Suspended', 'Terminated'))->default('On Review');

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
        Schema::drop('accounts');
    }
}
