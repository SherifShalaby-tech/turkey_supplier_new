<?php
namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call([
            LaratrustSeeder::class,
            AdminTableSeeder::class,
            aboutseeder::class,
            SettingSeeder::class,
            AdsSeeder::class,
            ShipmentSeeder::class,
            ServiceSeeder::class,
            CompanySeeder::class,
            ClerkSeeder::class,

        ]);

    }
}
