<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
       // Insert some stuff
        DB::table('users')->insert(
            array(
                [
                'id' => 1,
                'firstname' => 'William',
                'lastname' => 'Castillo',
                'username' => 'William Castillo',
                'email' => 'admin@sherifshalaby.tech',
                'password' => '$2y$10$9M5GCRwAeAKaND56Etso6eekWCvojRf/SaYymHYtueuyC7fO8ICCW',
                'avatar' => 'no_avatar.png',
                'phone' => '0123456789',
                'role_id' => 1,
                'type' => 1,
                'statut' => 1,
                    'trade_role' => 'buyer',
                    'company_id' => 1
                ],
                [
                    'id' => 2,
                    'firstname' => 'Mr',
                    'lastname' => 'Company',
                    'username' => 'Mr Company',
                    'email' => 'company@company.com',
                    'password' => '$2y$10$IFj6SwqC0Sxrsiv4YkCt.OJv1UV4mZrWuyLoRG7qt47mseP9mJ58u',
                    'avatar' => 'no_avatar.png',
                    'phone' => '0123456710',
                    'role_id' => 2,
                    'type' => 2,
                    'statut' => 1,
                    'trade_role' => 'buyer',
                    'company_id' => 1
                    ],

            )
        );
    }
}
