<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('groups')->insert([
    		'name' => 'De La Salle University, Manila',
    		'description' => "One of the leading research universities in the Philippines.",
    		'type' => "Education",
    		'address' => '2401 Taft Avenue',
    		'phone' => '63-2-123-4567',
    		'fax' => '63-2-987-6542'
    		]);

    	DB::table('groups')->insert([
    		'name' => 'De La Salle College of Saint Benilde',
    		'description' => "Amazing HRIM and Multimedia arts students.",
    		'type' => "Education",
    		'address' => '2402 Taft Avenue',
    		'phone' => '63-2-323-4347',
    		'fax' => '63-2-924-1242'
    		]);
    }
}
