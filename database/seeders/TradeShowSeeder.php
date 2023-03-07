<?php

namespace Database\Seeders;

use App\Models\Meditation;
use App\Models\TradeShow;
use App\Models\TranslationServices;
use Illuminate\Database\Seeder;

class TradeShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create mediation
        $mediation = Meditation::create([
            'image' => '74366467144.jpg',
            'title' => 'Mediation one'
        ]);

        // trade show
         $tradeShow = TradeShow::create([
             'image' => '4248869932-4.jpg',
             'title' => 'Trade Show one'
         ]);

        // translation services
        $tradeShow = TranslationServices::create([
            'image' => '70624576download.png',
            'title' => 'Translation Services one'
        ]);
    }
}
