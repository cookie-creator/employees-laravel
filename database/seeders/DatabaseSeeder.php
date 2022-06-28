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
            SEOEmployeeSeeder::class,
            QADepartmentSeeder::class,
            QAPerHourDepartmentSeeder::class,
            QAEmploeeSeeder::class,
            ProgrammersDepartmentMonthlySeeder::class,
            ProgrammersDepartmentPerHourSeeder::class,
            ProgrammersEmploeeSeeder::class
        ]);
    }
}
