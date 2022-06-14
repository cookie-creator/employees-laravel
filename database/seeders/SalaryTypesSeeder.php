<?php

namespace Database\Seeders;

use App\Models\SalaryTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salaryType = new SalaryTypes();
        $salaryType->title = 'per hour';
        $salaryType->type = 0;
        $salaryType->save();

        $salaryType = new SalaryTypes();
        $salaryType->title = 'monthly';
        $salaryType->type = 1;
        $salaryType->save();
    }
}
