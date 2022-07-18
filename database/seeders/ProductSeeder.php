<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'user_id' => 1,
                'category_id' => 3,
                'productName' => Str::random(10),
                'unitPrice' => 300.00,
                'image' => 'beauty.jpg',
                'discount' => 50.00
            ]);
        }
    }
}
