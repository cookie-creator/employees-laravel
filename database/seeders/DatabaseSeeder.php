<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SalaryTypesSeeder::class,
            SEODepartmentSeeder::class,
            QADepartmentSeeder::class,
            QAPerHourDepartmentSeeder::class,
            ProgrammersDepartmentMonthlySeeder::class,
            ProgrammersDepartmentPerHourSeeder::class,
            SEOEmployeeSeeder::class,
            QAEmploeeSeeder::class,
            ProgrammersEmploeeSeeder::class
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
