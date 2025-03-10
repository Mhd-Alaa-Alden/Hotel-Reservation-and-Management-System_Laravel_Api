<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('services')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('services')->insert([
            [
                'servicename' => 'Room Cleaning',
                'description' => 'Daily room cleaning service with full sanitation.',
                'price' => 50.00,
                'stock_quantity' => 100,
                'Services_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'servicename' => 'Laundry Service',
                'description' => 'Professional laundry service with same-day delivery.',
                'price' => 30.00,
                'stock_quantity' => 50,
                'Services_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'servicename' => 'Spa & Massage',
                'description' => 'Relaxing spa and massage therapy.',
                'price' => 120.00,
                'stock_quantity' => 20,
                'Services_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'servicename' => 'Airport Shuttle',
                'description' => 'Luxury airport shuttle service with premium vehicles.',
                'price' => 75.00,
                'stock_quantity' => 30,
                'Services_status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'servicename' => 'Fitness Center Access',
                'description' => 'Full access to the hotel gym and fitness center.',
                'price' => 20.00,
                'stock_quantity' => 200,
                'Services_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'servicename' => 'Gourmet Breakfast',
                'description' => 'Delicious gourmet breakfast served in the restaurant.',
                'price' => 15.00,
                'stock_quantity' => 500,
                'Services_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
