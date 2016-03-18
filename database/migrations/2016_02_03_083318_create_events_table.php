<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');                                         // Name of the event
            $table->text('description');                                    // Description of the event
            
            $table->dateTime('start_date');                                 // Date the event will be held
            $table->dateTime('end_date')->nullable();                       // Date the event will end
            
            $table->integer('expected_attendees')->unsigned();              // Expected amount of attendees
            $table->integer('actual_attendees')->unsigned()->nullable();    // Actual amount of attendees 

            // Has resource_id attribute, foreign key on resource
            $table->integer('resource_id')->unsigned()->nullable()->onDelete('cascade');
            $table->text('notes')->nullable();
            

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
        Schema::drop('events');
    }
}
