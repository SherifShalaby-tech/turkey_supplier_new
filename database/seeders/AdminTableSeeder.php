<?php
namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Faker\Factory;

class AdminTableSeeder extends Seeder {
    public function run() {
        $count = 50;
        $faker = Factory::create();
        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();
      //  DB::table('admins')->delete();
        $superAdmin = Admin::create([
                        'name'               =>'Ahmed Ragab',
                        'email'              =>'admin@admin.com',
                        'phone'              =>'0100000000',
                        'password'           =>bcrypt('123456'),
                        // 'type'               =>'admin',
                        'status'             =>Admin::ACTIVE,
                        'remember_token'     =>Str::random(10),
                    ]);
        $superAdmin->attachRole('super_admin');
        for ($i = 1; $i <= $count; $i++) {
            $admins[] = [
                'name'             => $faker->name(),
                'email'            => $faker->unique()->safeEmail(),
                'phone'            => $faker->numerify('###########'),
                'email_verified_at' => now(),
                'password'         => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'   => Str::random(10),
                'created_at'       => Carbon::now(),
                'status'           => Admin::ACTIVE,
                // 'type'             => $faker->randomElement(['admin', 'employee'])
            ];
            // $admins->attachRole('admin');
        }
        $chunks = array_chunk($admins, 100);
        foreach ($chunks as $chunk) {
            Admin::insert($chunk);
        }
        Schema::enableForeignKeyConstraints();
    }
}
