<?php
namespace Database\Seeders;

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
        DB::table('currencies')->insert(
            array(
                'id'     => 1,
                'code'   => 'EGP',
                'name'   => 'EGP',
                'symbol' => 'EGP',
            )

        );
    }
}
