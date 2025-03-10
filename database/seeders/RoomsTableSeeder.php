<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('rooms')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('rooms')->insert([
            [
                'category_id' => 1,
                'room_number' => 101,
                'capacity' => 2,
                'floor' => 1,
                'bathroom' => 1,
                'price' => 100.00,
                'images' => 'room1.jpg',
                'description' => 'Luxury suite with sea view.',
                'AvailabilityStatus' => 'AVAILABLE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'room_number' => 102,
                'capacity' => 3,
                'floor' => 1,
                'bathroom' => 1,
                'price' => 150.00,
                'images' => 'room2.jpg',
                'description' => 'Spacious deluxe room with balcony.',
                'AvailabilityStatus' => 'RESERVED', // متاح ضمن ENUM
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'room_number' => 201,
                'capacity' => 4,
                'floor' => 2,
                'bathroom' => 2,
                'price' => 200.00,
                'images' => 'room3.jpg',
                'description' => 'Family room with extra beds.',
                'AvailabilityStatus' => 'OCCUPIED',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'room_number' => 202,
                'capacity' => 1,
                'floor' => 2,
                'bathroom' => 1,
                'price' => 80.00,
                'images' => 'room4.jpg',
                'description' => 'Cozy single room for solo travelers.',
                'AvailabilityStatus' => 'AVAILABLE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'room_number' => 301,
                'capacity' => 5,
                'floor' => 3,
                'bathroom' => 2,
                'price' => 250.00,
                'images' => 'room5.jpg',
                'description' => 'Penthouse suite with panoramic view.',
                'AvailabilityStatus' => 'MAINTENANCE', // متاح ضمن ENUM
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'room_number' => 302,
                'capacity' => 2,
                'floor' => 3,
                'bathroom' => 1,
                'price' => 120.00,
                'images' => 'room6.jpg',
                'description' => 'Deluxe double room with garden view.',
                'AvailabilityStatus' => 'OUT_OF_SERVICE', // متاح ضمن ENUM
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
