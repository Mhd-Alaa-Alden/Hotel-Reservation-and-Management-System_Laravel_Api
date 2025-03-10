<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoyaltyProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('loyalty_programs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('loyalty_programs')->insert([
            [
                'LevelName' => 'Bronze',
                'condition_type' => 'points',
                'condition_value' => 500,
                'additional_services' => 'Late Checkout',
                'discount_rate' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'LevelName' => 'Silver',
                'condition_type' => 'points',
                'condition_value' => 1000,
                'additional_services' => 'Late Checkout, Free WiFi',
                'discount_rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'LevelName' => 'Gold',
                'condition_type' => 'points',
                'condition_value' => 2000,
                'additional_services' => 'Late Checkout, Free WiFi, Free Breakfast',
                'discount_rate' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
