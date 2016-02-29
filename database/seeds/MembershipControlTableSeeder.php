<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\User;

class MembershipControlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membership_manager = User::where('email', 'membershipmgr@gmail.com')->first();

        $date = Carbon::now()->addDays(rand(-6,0));
        DB::table('membership_controls')->insert([
    		'current_account_id' => 1,
    		'membership_slot_id' => 1,
            'posted_by_account_id' => $membership_manager->account->id,
            'created_at' => $date,
            'updated_at' => $date->addMinutes(15)
    		]);

        $date = Carbon::now()->addDays(rand(-6,0));
        DB::table('membership_controls')->insert([
            'current_account_id' => 2,
            'membership_slot_id' => 2,
            'posted_by_account_id' => $membership_manager->account->id,
            'created_at' => $date,
            'updated_at' => $date->addMinutes(15)
            ]);

        $date = Carbon::now()->addDays(rand(-6,0));
        DB::table('membership_controls')->insert([
            'current_account_id' => 3,
            'membership_slot_id' => 5,
            'posted_by_account_id' => $membership_manager->account->id,
            'created_at' => $date,
            'updated_at' => $date->addMinutes(15)
            ]);

        $date = Carbon::now()->addDays(rand(-6,0));
        DB::table('membership_controls')->insert([
            'current_account_id' => 4,
            'membership_slot_id' => 5,
            'posted_by_account_id' => 3,
            'created_at' => $date,
            'updated_at' => $date->addMinutes(15)
            ]);
    }
}
