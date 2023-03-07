<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        // Insert some stuff
	    DB::table('roles')->insert(
            array(
                [
                'id'    => 1,
                'name'  => 'Owner',
                'label' => 'Owner',
                'status' => 1,
                'description' => 'Owner',
            ],
            [
                'id'    => 2,
                'name'  => 'Company',
                'label' => 'Company',
                'status' => 1,
                'description' => 'Company',
            ],

            )
        );
    }
}
