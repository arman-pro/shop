<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoires = [
            'Electronics', 'Men Fashion', 'Women Fashion', 
            'Health & beauty', 'Groceris', 'Pet', 'Home & Lifestyles', 'Babys & Toys', 
            'Sports & Outdoor', 'Automotive & Motorbike', 'TV & Home Appliances',
        ];
        foreach ($categoires as $item) {
            $category = new Category();
            $category->user_id = 1;
            $category->name = $item;
            $category->slug = $item;
            $category->save();
        }
    }
}
