<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QADepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SEO
        $qaDepartment = new Department();
        $qaDepartment->title = 'QA';
        $qaDepartment->description = 'QA Department';
        $qaDepartment->save();

        $qaManager = new Position();
        $qaManager->title = 'QA Manager';
        $qaManager->description = 'QA Manager';
        $qaDepartment->positions()->save($qaManager);

        $qaManagerSalary = new Salary();
        $qaManagerSalary->title = 'QA Manager Salary';
        $qaManagerSalary->description = 'QA Manager Salary description';
        $qaManager->salary()->save($qaManagerSalary);

        $qaEmployee = new Position();
        $qaEmployee->title = 'QA Employee';
        $qaEmployee->description = 'QA Employee';
        $qaDepartment->positions()->save($qaEmployee);

        $qaEmployeeSalary = new Salary();
        $qaEmployeeSalary->title = 'SEO Employee Salary';
        $qaEmployeeSalary->description = 'SEO Employee Salary description';
        $qaEmployee->salary()->save($qaEmployeeSalary);
    }
}
