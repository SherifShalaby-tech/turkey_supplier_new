<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            ['id' => 1,'image' => 'image 5.png','title' => 'active'],
            ['id' => 2,'image' => 'image 5.png','title' => 'any title'],
        ];

        foreach ($ads as $ad){
            $adCreate = Ad::create($ad);
        }
    }
}
