<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
       // Insert some stuff
        DB::table('settings')->insert(
            array(
                'company_name' => "site name",
                'company_phone' => "address",
                'company_address' => "999999999",
                'email' => "test@test.com",
                'city' => "city",
                'facebook' => "www.facebook.com",
                'linkedin' => "www.linkedin.com",
                'phone' => "999999999",
                'logo' => "logo-invoices.jpg",
            )

        );
    }
}
