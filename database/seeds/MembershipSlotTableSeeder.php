<?php

use Illuminate\Database\Seeder;

class MembershipSlotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership_slots')->insert([
            'type' => 'Management',
            'description' => "You are part of the management."
            ]);
    	DB::table('membership_slots')->insert([
    		'type' => 'Co-owner',
    		'description' => "You are part of the founders of this golf club."
    		]);
    	DB::table('membership_slots')->insert([
    		'type' => 'Co-owner',
    		'description' => "You are part of the founders of this golf club."
    		]);
    	DB::table('membership_slots')->insert([
    		'type' => 'Standard',
    		'description' => "You were able to successfully apply for a membership slot."
    		]);
    	DB::table('membership_slots')->insert([
    		'type' => 'Standard',
    		'description' => "You were able to successfully apply for a membership slot."
    		]);
    	DB::table('membership_slots')->insert([
    		'type' => 'Standard',
    		'description' => "You were able to successfully apply for a membership slot."
    		]);
    	DB::table('membership_slots')->insert([
    		'type' => 'Standard',
    		'description' => "You were able to successfully apply for a membership slot."
    		]);
    }
}
