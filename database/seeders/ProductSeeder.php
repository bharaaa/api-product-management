<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('m_product')->insert([
            'id' => Str::uuid(),
            'product_category_id' => 'd3b92595-d262-4ee2-b472-e33b4edf8ff1',
            'name' => Str::random(10),
            'price' => rand(100, 1000),
            'image' => Str::random(10).'.jpg',
            'image_url' => 'https://'.Str::random(10).'.com/'.Str::random(10),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
