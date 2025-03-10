<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            categoryTableSeeder::class,
            EmployeesTableSeeder::class,
            FinancialTableSeeder::class,
            LoyaltyprogramsTableSeeder::class,
            ReservationsTableSeeder::class,
            UsersTableSeeder::class,
            ServicesTableSeeder::class,
            RoomsTableSeeder::class,
            categoryTableSeeder::class,
            RolesAndPermissionsSeeder::class,


        ]);
    }
}
