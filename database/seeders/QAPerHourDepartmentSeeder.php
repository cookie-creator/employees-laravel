<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QAPerHourDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SEO
        $qaDepartment = Department::where('title','QA')->first();

        $qaManager = new Position();
        $qaManager->title = 'QA Manager per hour';
        $qaManager->description = 'QA Manager per hour';
        $qaDepartment->positions()->save($qaManager);

        $qaManagerSalary = new Salary();
        $qaManagerSalary->title = 'QA Manager per hour Salary';
        $qaManagerSalary->amount = '400';
        $qaManagerSalary->salary_types_id = 1;
        $qaManager->salary()->save($qaManagerSalary);

        $qaEmployee = new Position();
        $qaEmployee->title = 'QA Employee per hour';
        $qaEmployee->description = 'QA Employee per hour';
        $qaDepartment->positions()->save($qaEmployee);

        $qaEmployeeSalary = new Salary();
        $qaEmployeeSalary->title = 'SEO Employee per hour Salary';
        $qaEmployeeSalary->amount = '100';
        $qaEmployeeSalary->salary_types_id = 1;
        $qaEmployee->salary()->save($qaEmployeeSalary);
    }
}
