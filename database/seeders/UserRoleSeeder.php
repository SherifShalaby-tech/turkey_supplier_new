<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        // Insert some stuff
        DB::table('role_user')->insert(
            array(
                [
                'id'      => 1,
                'user_id' => 1,
                'role_id' => 1,
                ],
                [
                    'id'      => 2,
                    'user_id' => 2,
                    'role_id' => 2,
                    ],


            )
        );
    }
}
