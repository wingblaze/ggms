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

        DB::table('users')->insert([
                'name' => 'Finance Manager',
                'email' => 'finmgr@gmail.com',
                'password' => bcrypt('secret'),
                'account_id' => 1,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Maintenance Manager',
                'email' => 'maintenancemgr@gmail.com',
                'password' => bcrypt('secret'),
                'account_id' => 1,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Alberto Roque',
                'email' => 'alberto.roque@gmail.com',
                'mobile_number' => '09178869476',
                'birth_date' => '1950-12-04',
                'birth_place' => 'Pasay City',
                'nationality' => 'Filipino',
                'gender' => 'male',
                'salutation' => 'Mr.',
                'civil_status' => 'Married',
                'created_at' => '2016-02-09',
                'password' => bcrypt('secret'),
                'account_id' => 2,
                'account_type' => 'owner'
                ]);

        DB::table('users')->insert([
                'name' => 'Elena Roque',
                'email' => 'elena.roque@gmail.com',
                'mobile_number' => '09172346723',
                'birth_date' => '1954-08-04',
                'birth_place' => 'Tacloban City',
                'nationality' => 'Filipino',
                'gender' => 'female',
                'salutation' => 'Mrs.',
                'civil_status' => 'Married',
                'created_at' => '2016-03-09',
                'password' => bcrypt('secret'),
                'account_id' => 2,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Harold Roque',
                'email' => 'harold.roque@gmail.com',
                'mobile_number' => '09165543256',
                'birth_date' => '1980-11-16',
                'birth_place' => 'Makati City',
                'nationality' => 'Filipino',
                'gender' => 'male',
                'salutation' => 'Mr.',
                'civil_status' => 'Single',
                'created_at' => '2016-02-05',
                'password' => bcrypt('secret'),
                'account_id' => 2,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Alyssa Roque',
                'email' => 'alyssa.roque@gmail.com',
                'mobile_number' => '09156689451',
                'birth_date' => '1982-12-04',
                'birth_place' => 'Makati City',
                'nationality' => 'Filipino',
                'gender' => 'female',
                'salutation' => 'Ms.',
                'civil_status' => 'Single',
                'created_at' => '2016-06-09',
                'password' => bcrypt('secret'),
                'account_id' => 2,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Renato Dee',
                'email' => 'renato.dee@gmail.com',
                'mobile_number' => '09224456890',
                'birth_date' => '1956-01-04',
                'birth_place' => 'Davao City',
                'nationality' => 'Filipino',
                'gender' => 'male',
                'salutation' => 'Mr.',
                'civil_status' => 'Married',
                'created_at' => '2016-06-06',
                'password' => bcrypt('secret'),
                'account_id' => 3,
                'account_type' => 'owner'
                ]);

        DB::table('users')->insert([
                'name' => 'Marian Dee',
                'email' => 'marian.dee@gmail.com',
                'mobile_number' => '09229956732',
                'birth_date' => '1959-05-30',
                'birth_place' => 'Davao City',
                'nationality' => 'Filipino',
                'gender' => 'female',
                'salutation' => 'Mrs.',
                'civil_status' => 'Married',
                'created_at' => '2016-08-06',
                'password' => bcrypt('secret'),
                'account_id' => 3,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Layla Dee',
                'email' => 'layla.dee@gmail.com',
                'mobile_number' => '09225439076',
                'birth_date' => '1989-11-14',
                'birth_place' => 'Manila City',
                'nationality' => 'Filipino',
                'gender' => 'female',
                'salutation' => 'Ms.',
                'civil_status' => 'Single',
                'created_at' => '2016-04-06',
                'password' => bcrypt('secret'),
                'account_id' => 3,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Sarah Dee',
                'email' => 'sarah.dee@gmail.com',
                'mobile_number' => '09228832579',
                'birth_date' => '1990-03-27',
                'birth_place' => 'Manila City',
                'nationality' => 'Filipino',
                'gender' => 'female',
                'salutation' => 'Ms.',
                'civil_status' => 'Single',
                'created_at' => '2016-12-06',
                'password' => bcrypt('secret'),
                'account_id' => 3,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Trevor Estrella',
                'email' => 'trevor.estrella@gmail.com',
                'mobile_number' => '09165456880',
                'birth_date' => '1952-06-02',
                'birth_place' => 'General Santos City',
                'nationality' => 'Filipino',
                'gender' => 'male',
                'salutation' => 'Mr.',
                'civil_status' => 'Married',
                'created_at' => '2016-02-16',
                'password' => bcrypt('secret'),
                'account_id' => 4,
                'account_type' => 'owner'
                ]);

        DB::table('users')->insert([
                'name' => 'Elizabeth Estrella',
                'email' => 'elizabeth.estrella@gmail.com',
                'mobile_number' => '09157758340',
                'birth_date' => '1952-06-02',
                'birth_place' => 'Batangas City',
                'nationality' => 'Filipino',
                'gender' => 'female',
                'salutation' => 'Mrs.',
                'civil_status' => 'Married',
                'created_at' => '2016-12-16',
                'password' => bcrypt('secret'),
                'account_id' => 4,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Maxwell Estrella',
                'email' => 'maxwell.estrella@gmail.com',
                'mobile_number' => '09160218762',
                'birth_date' => '1983-10-06',
                'birth_place' => 'Manila City',
                'nationality' => 'Filipino',
                'gender' => 'male',
                'salutation' => 'Mr.',
                'civil_status' => 'Single',
                'created_at' => '2016-12-16',
                'password' => bcrypt('secret'),
                'account_id' => 4,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Garret Cerezo',
                'email' => 'garret.cerezo@gmail.com',
                'mobile_number' => '09197786643',
                'birth_date' => '1965-06-02',
                'birth_place' => 'Cebu City',
                'nationality' => 'Filipino',
                'gender' => 'male',
                'salutation' => 'Mr.',
                'civil_status' => 'Married',
                'created_at' => '2016-11-18',
                'password' => bcrypt('secret'),
                'account_id' => 5,
                'account_type' => 'owner'
                ]);

        DB::table('users')->insert([
                'name' => 'Holly Cerezo',
                'email' => 'holly.cerezo@gmail.com',
                'mobile_number' => '09198869305',
                'birth_date' => '1968-12-12',
                'birth_place' => 'New York City',
                'nationality' => 'American',
                'gender' => 'female',
                'salutation' => 'Mrs.',
                'civil_status' => 'Married',
                'created_at' => '2016-07-18',
                'password' => bcrypt('secret'),
                'account_id' => 5,
                'account_type' => 'dependent'
                ]);

        DB::table('users')->insert([
                'name' => 'Alexander Cerezo',
                'email' => 'alexander.cerezo@gmail.com',
                'mobile_number' => '09194536243',
                'birth_date' => '1993-12-24',
                'birth_place' => 'Calfornia City',
                'nationality' => 'Filipino',
                'gender' => 'male',
                'salutation' => 'Mr.',
                'civil_status' => 'Single',
                'created_at' => '2016-04-18',
                'password' => bcrypt('secret'),
                'account_id' => 5,
                'account_type' => 'dependent'
                ]);

        $affected_rows = DB::update("UPDATE `users` SET `name` = CONCAT(`name`, ' (', `id`, ')')");
    }
}
