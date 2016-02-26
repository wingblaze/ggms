<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MembershipSlotTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(MembershipControlTableSeeder::class);
        
        $this->call(UserTableSeeder::class);

        $this->call(GroupTableSeeder::class);

        $this->call(ResourceTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(RentResourceTableSeeder::class);

        $this->call(ComplaintTableSeeder::class);

        $this->call(ACLSeeder::class);
        
    }
}
