<?php
namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Clerk;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Faker\Factory;

class ClerkSeeder extends Seeder {
    public function run() {
        $count = 50;
        $faker = Factory::create();
        Schema::disableForeignKeyConstraints();
        DB::table('clerks')->truncate();
        $clerk = Clerk::create([
            'name'               =>'Clerk Ahmed Ragab',
            'email'              =>'c@c.com',
            'phone'              =>'0100000000',
            'password'           =>bcrypt('123456'),
            'status'             =>1,
            'company_id'         =>1,
            'remember_token'     =>Str::random(10),
        ]);
        $clerk->attachRole('clerk');
        // for ($i = 1; $i <= $count; $i++) {
        //     $clerks[] = [
        //         'name'             => $faker->name(),
        //         'email'            => $faker->unique()->safeEmail(),
        //         'phone'            => $faker->numerify('###########'),
        //         'email_verified_at' => now(),
        //         'password'         => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'remember_token'   => Str::random(10),
        //         'created_at'       => Carbon::now(),
        //         'company_id'       => rand(1,5),
        //         'status'           => 1,
        //     ];
            // $clerks->attachRole('clerk');
        // }
        // $chunks = array_chunk($clerks, 100);
        // foreach ($chunks as $chunk) {
        //     Clerk::insert($chunk);
        // }
        Schema::enableForeignKeyConstraints();
    }
}
