<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // mobile_number, birth_date (YYYY-MM-DD), birth_place, nationality, salutation, civil_status, created_at (2016-02-17 13:00:00.000000)
        DB::table('users')->insert([
                'name' => 'System Administrator',
                'email' => 'sysadmin@gmail.com',
                'password' => bcrypt('secret'),
                'account_id' => 1,
                'account_type' => 'owner'
                ]);

        DB::table('users')->insert([
                'name' => 'Golf Operations Manager',
                'email' => 'golfopsmgr@gmail.com',
                'password' => bcrypt('secret'),
                'account_id' => 1,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Marketing Manager',
                'email' => 'mktgmgr@gmail.com',
                'password' => bcrypt('secret'),
                'account_id' => 1,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Membership Manager',
                'email' => 'membershipmgr@gmail.com',
                'password' => bcrypt('secret'),
                'account_id' => 1,
                'account_type' => 'dependent'
                ]);

        $names = ["Juan Dela Cruz", "Mark Mindoro", "Rylee Alejandro", "Melvin Roxas", "Peyton Barcelona", "Nicolas Magsino", "Stefano Recio", "Bernardo Espejo", "Felix Salvador", "Basilio Casis"];
        $email = ["juan.dela.cruz", "mark.mindoro", "rylee.alejandro", "melvin.roxas", "peyton.barcelona", "nicolas.magsino", "stefano.recio", "bernardo.espejo", "felix.salvador", "basilio.casis"];

    	for ($i = 0; $i < 10; $i++) {
            $first_entry = $i < 3;

    		DB::table('users')->insert([
    			'name' => $names[$i],
    			'email' => $email[$i].'@gmail.com',
    			'password' => bcrypt('secret'),
                'account_id' => $i % 3 + 2,
                'account_type' => ($first_entry) ? 'owner' : 'dependent'
    			]);
    	}
    }
}
