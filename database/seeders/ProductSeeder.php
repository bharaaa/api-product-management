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
            'product_category_id' => 'b1739f87-7292-4c81-81ac-db50790a8efe',
            'name' => Str::random(10),
            'price' => rand(100, 1000),
            'image' => Str::random(10).'.jpg',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
