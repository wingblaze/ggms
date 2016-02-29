<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
                'expiration' => date('Y-m-d', strtotime('+10 year')),
                'business_address' => "Golf Management",
                'home_address' => "Golf Management",
                'phone' => "82-123-4567-89",
                'fax' => "123-4567",
                'status' => 'Active',
                'tin_number' => '12342341241234',
                'residence_certificate_id' => '12341341234',
                'residence_certificate_place_issued' => 'Makati',
                'residence_certificate_date_issued' => date('Y-m-d', strtotime('-1 month')),
                ]);

        DB::table('accounts')->insert([
    			'expiration' => date('Y-m-d', strtotime('+8 week')),
                'business_address' => "1234 ABC Street, New York, U.S.A.",
                'home_address' => "1234 ABC Home Avenue, New York, U.S.A.",
    			'phone' => "82-123-4567-89",
    			'fax' => "123-4567",
    			'status' => 'Active',
                'tin_number' => '14364364',
                'residence_certificate_id' => '4523423',
                'residence_certificate_place_issued' => 'Guadalupe',
                'residence_certificate_date_issued' => date('Y-m-d', strtotime('-2 month')),
    			]);

        DB::table('accounts')->insert([
    			'expiration' => date('Y-m-d', strtotime('+8 week')),
                'business_address' => "2957 JJJ Street, Chicago, U.S.A.",
                'home_address' => "2957 JJJ Home Avenue, Chicago, U.S.A.",
    			'phone' => "82-821-1093-89",
    			'fax' => "123-2045",
    			'status' => 'Inactive',
                'tin_number' => '3452354',
                'residence_certificate_id' => '1231231',
                'residence_certificate_place_issued' => 'Ortigas',
                'residence_certificate_date_issued' => date('Y-m-d', strtotime('-3 month')),
    			]);

        DB::table('accounts')->insert([
                'expiration' => date('Y-m-d', strtotime('+8 week')),
                'business_address' => "9673 FFF Street, Illinois, U.S.A.",
                'home_address' => "9673 FFF Home Avenue, Illinois, U.S.A.",
                'phone' => "82-821-6048-89",
                'fax' => "693-2102",
                'status' => 'On Review',
                'tin_number' => '23424',
                'residence_certificate_id' => '675675',
                'residence_certificate_place_issued' => 'Pasay',
                'residence_certificate_date_issued' => date('Y-m-d', strtotime('-2 month')),
                ]);

        DB::table('accounts')->insert([
                'expiration' => date('Y-m-d', strtotime('+12 week')),
                'business_address' => "7141 JHG Street, Brooklyn, U.S.A.",
                'home_address' => "7141 JHG Street, Brooklyn, U.S.A.",
                'phone' => "01-952-6233-89",
                'fax' => "8245-1842",
                'status' => 'On Review',
                'tin_number' => '49486',
                'residence_certificate_id' => '13718',
                'residence_certificate_place_issued' => 'Magallanes',
                'residence_certificate_date_issued' => date('Y-m-d', strtotime('-6 month')),
                ]);
    }
}
