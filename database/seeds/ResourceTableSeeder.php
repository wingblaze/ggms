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
    			'name' => "Dining Hall A"
    			]);

        DB::table('resources')->insert([
    			'name' => "Dining Hall B"
    			]);

        DB::table('resources')->insert([
    			'name' => "Swimming Pool"
    			]);

        DB::table('resources')->insert([
    			'name' => "Event Area"
    			]);
    }
}
