<?php

use Illuminate\Database\Seeder;

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

		DB::table('rent_resources')->insert([
		'user_id' => 6,
		'resource_id' => 2,
		'start_time' => $now,
		'end_time' => $now
		]);

    }
}
