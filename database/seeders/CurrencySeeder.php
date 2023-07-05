<?php
namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
       	// Insert some stuff
        $currency = Currency::create([
            'code' => 'USD',
            'name' => 'dollar',
            'symbol' => '$'
        ]);
        $currency = Currency::create([
            'code' => 'TRY',
            'name' => 'lira',
            'symbol' => '₺'
        ]);
    }
}
