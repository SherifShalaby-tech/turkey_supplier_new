<?php
namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\TranslationServices;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Faker\Factory;
class TranslationServiceSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('translation_services')->truncate();
        TranslationServices::create([
            'name'               =>'test',
            'companyname'        =>'test test',
            'phone'              =>'0100000000',
            'country'            =>'turkey',
            'language'           =>'turkish',
            ]);
        Schema::enableForeignKeyConstraints();
    }
}
