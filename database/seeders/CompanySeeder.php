<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('companies')->truncate();
        $company = Company::create([
            'name'=>'company',
            'email'=>'com@com.com',
            'password'=>bcrypt('123456'),
            'remember_token'=>Str::random(10),
            'created_at'=>now(),
        ]);
         $company->attachRole('company');
        // $companies = [
        //     ['id' => 1,'name' => 'company1','created_at'=>now(),
        //     'email'=>'com1@com.com','password'=>bcrypt('123456'),'remember_token'=>Str::random(10),],
        //     ['id' => 2,'name' => 'company2','created_at'=>now(),'email'=>'com2@com.com','password'=>bcrypt('123456'),'remember_token'=>Str::random(10),],
        // ];

        // foreach ($companies as $company){
        //     DB::table('companies')->insert($company);
        // }
    }
}
