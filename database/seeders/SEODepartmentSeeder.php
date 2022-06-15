<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SEODepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SEO
        $seoDepartment = new Department();
        $seoDepartment->title = 'SEO';
        $seoDepartment->description = 'SEO Department';
        $seoDepartment->save();

        $seoManager = new Position();
        $seoManager->title = 'SEO Manager';
        $seoManager->description = 'SEO Manager';
        $seoDepartment->positions()->save($seoManager);

        $seoManagerSalary = new Salary();
        $seoManagerSalary->title = 'SEO Manager Salary';
        $seoManagerSalary->amount = '5000';
        $seoManagerSalary->salary_types_id = 2;
        $seoManager->salary()->save($seoManagerSalary);

        $seoEmployee = new Position();
        $seoEmployee->title = 'SEO Employee';
        $seoEmployee->description = 'SEO Employee';
        $seoDepartment->positions()->save($seoEmployee);

        $seoEmployeeSalary = new Salary();
        $seoEmployeeSalary->title = 'SEO Employee Salary';
        $seoEmployeeSalary->amount = '80';
        $seoEmployeeSalary->salary_types_id = 1;
        $seoEmployee->salary()->save($seoEmployeeSalary);
    }
}
