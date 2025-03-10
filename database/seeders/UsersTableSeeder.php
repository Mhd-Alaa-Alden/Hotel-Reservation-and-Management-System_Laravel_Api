<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); 
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'alaa@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('password123'),
                'phone' => 123450,
                'image' => 'john_doe.jpg',
                'total_points' => 500,
                'loyalty_level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alice Smith',
                'email' => 'alice@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'phone' => 98765,
                'image' => 'alice_smith.jpg',
                'total_points' => 1200,
                'loyalty_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
