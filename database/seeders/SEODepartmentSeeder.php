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
        $seoManagerSalary->description = 'SEO Manager Salary description';
        $seoManager->salary()->save($seoManagerSalary);

        $seoEmployee = new Position();
        $seoEmployee->title = 'SEO Employee';
        $seoEmployee->description = 'SEO Employee';
        $seoDepartment->positions()->save($seoEmployee);

        $seoEmployeeSalary = new Salary();
        $seoEmployeeSalary->title = 'SEO Employee Salary';
        $seoEmployeeSalary->description = 'SEO Employee Salary description';
        $seoEmployee->salary()->save($seoEmployeeSalary);
    }
}
