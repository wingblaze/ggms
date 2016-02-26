<?php

use Illuminate\Database\Seeder;

class MembershipControlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership_controls')->insert([
    		'account_id' => 1,
    		'membership_slot_id' => 1
    		]);

        DB::table('membership_controls')->insert([
            'account_id' => 2,
            'membership_slot_id' => 2
            ]);

        DB::table('membership_controls')->insert([
            'account_id' => 3,
            'membership_slot_id' => 5
            ]);
    }
}
