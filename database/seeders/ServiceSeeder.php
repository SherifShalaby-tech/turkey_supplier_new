<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['id' => 1,'name' => 'Mediation','admin_id' => 1],
            ['id' => 2,'name' =>  'Translation Services','admin_id' => 1],
            ['id' => 3,'name' => 'Trade Show','admin_id' => 1],
        ];

        foreach ($services as $service){
            $service_create = Service::create($service);
        }
    }
}
