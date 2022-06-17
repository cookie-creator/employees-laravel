<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QAEmploeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $qaDepartment = Department::where('title', 'QA')->first();
        $qaQAManagerPosition = $qaDepartment->positions->where('title','QA Manager')->first();
        $seoQAManagerSalary = $qaQAManagerPosition->salary->first();

        $salary = new EmployeeSalary();
        $salary->amount = '4000';
        $salary->salary_types_id = 2;
        $salary->save();

        $seoManagerEmployee = new Employee();
        $seoManagerEmployee->firstname = 'Karl';
        $seoManagerEmployee->surname = 'Urban';
        $seoManagerEmployee->lastname = 'QA wizard';
        $seoManagerEmployee->date_of_birth = "1972-06-14";
        $seoManagerEmployee->department_id = $qaDepartment->id;
        $seoManagerEmployee->position_id = $qaQAManagerPosition->id;
        $seoManagerEmployee->salary_id = $seoQAManagerSalary->id;
        $seoManagerEmployee->employee_salary_id = $salary->id;
        $seoManagerEmployee->save();

        $salary = new EmployeeSalary();
        $salary->amount = '3000';
        $salary->salary_types_id = 2;
        $salary->save();

        $seoManagerEmployee = new Employee();
        $seoManagerEmployee->firstname = 'David';
        $seoManagerEmployee->surname = 'Sheen';
        $seoManagerEmployee->lastname = 'Markovich';
        $seoManagerEmployee->date_of_birth = "1990-06-14";
        $seoManagerEmployee->department_id = $qaDepartment->id;
        $seoManagerEmployee->position_id = $qaQAManagerPosition->id;
        $seoManagerEmployee->salary_id = $seoQAManagerSalary->id;
        $seoManagerEmployee->employee_salary_id = $salary->id;
        $seoManagerEmployee->save();

        // Monthly
        $department = Department::where('title', 'QA')->first();
        $position = $department->positions->where('title','QA Employee')->first();
        $salary = $position->salary->first();
        for ($i=1; $i<=10; $i++)
        {
            $employeeSalary = new EmployeeSalary();
            $employeeSalary->amount = '3000';
            $employeeSalary->salary_types_id = 2;
            $employeeSalary->save();

            $data[] = [
                'firstname' => 'Erin'.$i,
                'surname' => 'Moriarty'.$i,
                'lastname' => 'Starlight',
                'date_of_birth' => "1982-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
                'employee_salary_id' => $employeeSalary->id,
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }

        $data = [];

        // per hour
        $position = $department->positions->where('title','QA Employee per hour')->first();
        info($department->positions);
        $salary = $position->salary->first();
        for ($i=1; $i<=10; $i++)
        {
            $employeeSalary = new EmployeeSalary();
            $employeeSalary->amount = '300';
            $employeeSalary->salary_types_id = 1;
            $employeeSalary->save();

            $data[] = [
                'firstname' => 'John'.$i,
                'surname' => 'Doe'.$i,
                'lastname' => 'Perhour',
                'date_of_birth' => "1982-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
                'employee_salary_id' => $employeeSalary->id,
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }
    }
}
