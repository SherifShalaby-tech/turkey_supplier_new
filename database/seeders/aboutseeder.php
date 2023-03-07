<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class aboutseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about_us')->insert(
            array(
                'about_us' => 'The first thing to keep in mind is that your About Us page is not just about you – it’s about what you can do for potential customers, and why you should be the one to do it. Therefore, you’ll want to make sure you provide some background on both your products and your team. You’ll also want to emphasize the core values that make your company unique.',
                'services' => 'The first thing to keep in mind is that your About Us page is not just about you – it’s about what you can do for potential customers, and why you should be the one to do it. Therefore, you’ll want to make sure you provide some background on both your products and your team. You’ll also want to emphasize the core values that make your company unique.            ',
                'shipping_products' => 'The first thing to keep in mind is that your About Us page is not just .',
                'mediation' => 'The first thing to keep in mind is that your About Us page is not just .',
            )
        );
    }
}
