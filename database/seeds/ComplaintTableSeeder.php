<?php

use Illuminate\Database\Seeder;

class ComplaintTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complaints')->insert([
    		'user_id' => 5,
    		'account_id' => 4,
    		'content' => "He looks like a bad man."
    		]);
    }
}
