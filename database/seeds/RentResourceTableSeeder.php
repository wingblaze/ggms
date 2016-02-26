<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RentResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$now = date('Y-m-d H:i:s');

        DB::table('rent_resources')->insert([
		'user_id' => 5,
		'resource_id' => 1,
		'start_time' => $now,
		'end_time' => $now
		]);

        // pick dates for start_time and end time like this
        // 
		// $date = new Carbon('first day of December 2008')
		// $date = Carbon::parse('1975-05-21 22:23:00.123456');

		DB::table('rent_resources')->insert([
		'user_id' => 6,
		'resource_id' => 2,
		'start_time' => $now,
		'end_time' => $now
		]);

    }
}
