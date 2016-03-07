<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\User;
use App\MembershipSlot;
use App\MembershipControl;

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
            'posted_by_account_id' => 1,
            'created_at' => $date,
            'updated_at' => $date->addMinutes(-15)
    		]);

        $date = Carbon::now()->addDays(rand(-6,0));
        DB::table('membership_controls')->insert([
            'current_account_id' => 2,
            'membership_slot_id' => 2,
            'posted_by_account_id' => 1,
            'created_at' => $date,
            'updated_at' => $date->addMinutes(-10)
            ]);

        $date = Carbon::now()->addDays(rand(-6,0));
        DB::table('membership_controls')->insert([
            'current_account_id' => 3,
            'membership_slot_id' => 5,
            'posted_by_account_id' => 1,
            'created_at' => $date,
            'updated_at' => $date->addMinutes(-7)
            ]);

        $date = Carbon::now()->addDays(rand(-6,0));
        DB::table('membership_controls')->insert([
            'current_account_id' => 4,
            'membership_slot_id' => 5,
            'posted_by_account_id' => 3,
            'created_at' => $date,
            'updated_at' => $date->addMinutes(-3)
            ]);

        $admin = MembershipSlot::find(1);
        $admin->membership_control_id = MembershipControl::find(1)->id;

        $admin = MembershipSlot::find(2);
        $admin->membership_control_id = MembershipControl::find(2)->id;

        $admin = MembershipSlot::find(5);
        $admin->membership_control_id = MembershipControl::find(4)->id;
    }
}
