<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('financialmanagements')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('financialmanagements')->insert([
            [
                'category' => 'revenue',
                'source' => 'Reservations',
                'amount' => 5000.00,
                'total_amount' => 5000.00,
                'description' => 'Income from room reservations for the month of January.',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'expense',
                'source' => 'Services',
                'amount' => 1200.00,
                'total_amount' => 3800.00,
                'description' => 'Maintenance costs for HVAC and plumbing repairs.',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'revenue',
                'source' => 'Services',
                'amount' => 3000.00,
                'total_amount' => 6800.00,
                'description' => 'Revenue generated from restaurant services.',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'expense',
                'source' => 'other',
                'amount' => 2000.00,
                'total_amount' => 4800.00,
                'description' => 'Monthly salaries for hotel staff.',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'revenue',
                'source' => 'Reservations',
                'amount' => 7000.00,
                'total_amount' => 11800.00,
                'description' => 'Income from corporate events and wedding bookings.',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'expense',
                'source' => 'other',
                'amount' => 1500.00,
                'total_amount' => 10300.00,
                'description' => 'Social media and digital advertising expenses.',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
