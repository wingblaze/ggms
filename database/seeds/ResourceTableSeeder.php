<?php

use Illuminate\Database\Seeder;

class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert([
    			'name' => "Dining Hall A",
                'type' => "events"
    			]);

        DB::table('resources')->insert([
    			'name' => "Dining Hall B",
                'type' => "events"
    			]);

        DB::table('resources')->insert([
                'name' => "Swimming Pool",
                'type' => "sports"
                ]);

        DB::table('resources')->insert([
                'name' => "Basketball Court",
                'type' => "sports"
                ]);

        DB::table('resources')->insert([
                'name' => "Badmintion Court",
                'type' => "sports"
                ]);

        DB::table('resources')->insert([
                'name' => "Tennis Court",
                'type' => "sports"
                ]);

        DB::table('resources')->insert([
    			'name' => "Event Area",
                'type' => "golf"
    			]);
    }
}
