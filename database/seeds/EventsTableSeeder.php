<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$now = date('Y-m-d H:i:s');

        DB::table('events')->insert([
    			'name' => "Paolo's Birthday",
                'description' => "It's a special day because today was the day I was born! Come join my party with Jollibee!",
    			'start_date' => $now,
                'end_date' => date('Y-m-d H:i:s', strtotime('+3 hour'))
    			]);

        DB::table('events')->insert([
                'name' => "Victor's Birthday",
                'description' => "Lorem ipsum dolor iset; the quick brown fox jumps over the lazy dog.",
                'start_date' => $now,
                'end_date' => date('Y-m-d H:i:s', strtotime('+4 hour'))
                ]);

        DB::table('events')->insert([
                'name' => "Swimming-palooza",
                'description' => "Have fun swimming! Earn more points!",
                'start_date' => Carbon::now()->addDays(-5),
                'end_date' => Carbon::now()->addDays(+12)
                ]);
    }
}
