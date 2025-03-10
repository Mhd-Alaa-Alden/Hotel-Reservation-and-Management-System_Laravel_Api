<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::table('users')->pluck('id')->toArray();

        if (empty($users)) {
            echo " لا يوجد مستخدمون في قاعدة البيانات، تأكد من تشغيل UsersTableSeeder أولاً.\n";
            return;
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('reservations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('reservations')->insert([
            [
                'user_id' => $users[0] ?? 1,
                'guest_name' => 'John Doe',
                'guest_email' => 'john@example.com',
                'guest_phone' => 123456789,
                'total_amount' => 500.00,
                'notes' => 'Check-in at 3 PM',
                'Reservation_status' => 'CONFIRMED',
                'services_requested' => 'YES',
                'payment_method' => 'CREDIT_CARD',
                'payment_status' => 'COMPLETED',
                'payment_reference' => 'TXN123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users[1] ?? 2,
                'guest_name' => 'Alice Smith',
                'guest_email' => 'alice@example.com',
                'guest_phone' => 987654321,
                'total_amount' => 1000.00,
                'notes' => 'Need extra pillows',
                'Reservation_status' => 'CONFIRMED',
                'services_requested' => 'YES',
                'payment_method' => 'BANK_TRANSFER',
                'payment_status' => 'PENDING',
                'payment_reference' => 'TXN987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
