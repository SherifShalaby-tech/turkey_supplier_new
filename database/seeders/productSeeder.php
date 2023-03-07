<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1,'name' => 'Machinery'],
            ['id' => 2,'name' => 'Vehicle-Parts-Accessories'],
        ];

        foreach ($categories as $category) {
           Category::create($category);
        }
        $subCategories = [
            ['id' => 1,'name' => 'Agricultural Machinery-Equipment','category_id' => 1,'image' => 'speaker-1.jpg'],
            ['id' => 2,'name' => 'Apparel-Fashion-Accessories-Jewelry','category_id' => 1,'image' => 'speaker-1.jpg'],
            ['id' => 3,'name' => 'Buliding-Material-Machinery','category_id' => 1,'image' => 'speaker-1.jpg'],
            ['id' => 4,'name' => 'Chimical-Pharmaceuutical-Machinery','category_id' => 1,'image' => 'speaker-1.jpg'],
            ['id' => 5,'name' => 'Cleaning-Equipment','category_id' => 1,'image' => 'speaker-1.jpg'],
            ['id' => 6,'name' => 'Electrical-Equipment-Manufactruing-Machinery','category_id' => 1,'image' => 'speaker-1.jpg'],

            ['id' => 7,'name' => 'Agricultural-Machinery-Equipment','category_id' => 2,'image' => 'speaker-1.jpg'],
            ['id' => 8,'name' => 'Apparel-Fashion-Accessories-Jewelry','category_id' => 2,'image' => 'speaker-1.jpg'],
            ['id' => 9,'name' => 'Buliding-Material-Machinery','category_id' => 2,'image' => 'speaker-1.jpg'],
            ['id' => 10,'name' => 'Chimical-Pharmaceuutical-Machinery','category_id' => 2,'image' => 'speaker-1.jpg'],
            ['id' => 11,'name' => 'Cleaning-Equipment','category_id' => 2,'image' => 'speaker-1.jpg'],
            ['id' => 12,'name' => 'Electrical-Equipment-Manufactruing-Machinery','category_id' => 2,'image' => 'speaker-1.jpg'],
        ];
        foreach ($subCategories as $sub){
            $sub = SubCategories::create($sub);
        }
        // create product
        $product = Product::create([
            'code' => '#2033',
            // 'Type_barcode' => 'type',
            'name' => 'product1',
            'price' => 500,
            // 'cost' => 600,
            'category_id' => 1,
            'sub_category_id' => 1,
            'company_id' => 1,
            'description' => 'product bla bla bla',
            'video_description' => 'https://www.w3schools.com/html/mov_bbb.mp4',

        ]);
        // create slug
        $slug = Product::where('id',$product['id'])->latest()->update(['slug' => Str::slug($product['name'])]);
    }
}
