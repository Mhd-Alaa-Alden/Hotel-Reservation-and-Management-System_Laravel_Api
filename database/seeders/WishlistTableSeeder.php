<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('wishlists')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('wishlists')->insert([
            [
                'user_id' => 7,
                'room_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'room_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'room_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'room_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'room_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 12,
                'room_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
