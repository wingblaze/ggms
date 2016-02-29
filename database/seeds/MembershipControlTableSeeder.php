<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
    		'membership_slot_id' => 1,
            'created_at' => Carbon::now()->addDays(rand(-6,0))
    		]);

        DB::table('membership_controls')->insert([
            'account_id' => 2,
            'membership_slot_id' => 2,
            'created_at' => Carbon::now()->addDays(rand(-6,0))
            ]);

        DB::table('membership_controls')->insert([
            'account_id' => 3,
            'membership_slot_id' => 5,
            'created_at' => Carbon::now()->addDays(rand(-6,0))
            ]);

        DB::table('membership_controls')->insert([
            'account_id' => 3,
            'membership_slot_id' => NULL,
            'created_at' => Carbon::now()->addDays(rand(-6,0))
            ]);
    }
}
