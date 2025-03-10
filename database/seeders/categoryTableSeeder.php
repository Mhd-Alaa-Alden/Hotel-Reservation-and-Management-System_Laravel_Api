<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categorys')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); 
        DB::table('categorys')->insert([
            [
                'category_name' => 'Standard Room',
                'description' => 'A comfortable room with basic amenities.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Deluxe Room',
                'description' => 'A spacious room with additional features and luxury.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Suite',
                'description' => 'A premium suite with a separate living area.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Penthouse',
                'description' => 'A luxurious top-floor suite with stunning views.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Family Room',
                'description' => 'A large room suitable for families with children.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Presidential Suite',
                'description' => 'An exclusive suite offering the ultimate luxury experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
