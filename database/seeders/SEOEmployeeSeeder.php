<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SEOEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SEO
        $seoDepartment = Department::where('title', 'SEO')->first();
        $seoManagerPosition = $seoDepartment->positions->where('title', 'SEO Manager')->first();
        $seoManagerSalary = $seoManagerPosition->salary->first();

        $salary = new EmployeeSalary();
        $salary->amount = '5000';
        $salary->salary_types_id = 2;
        $salary->save();

        $seoManagerEmployee = new Employee();
        $seoManagerEmployee->firstname = 'Liza';
        $seoManagerEmployee->surname = 'Simpson';
        $seoManagerEmployee->lastname = 'SEO wizard';
        $seoManagerEmployee->date_of_birth = "1990-06-14";
        $seoManagerEmployee->department_id = $seoDepartment->id;
        $seoManagerEmployee->position_id = $seoManagerPosition->id;
        $seoManagerEmployee->salary_id = $seoManagerSalary->id;
        $seoManagerEmployee->employee_salary_id = $salary->id;
        $seoManagerEmployee->save();

        $salary = new EmployeeSalary();
        $salary->amount = '4000';
        $salary->salary_types_id = 2;
        $salary->save();

        $seoManagerEmployee = new Employee();
        $seoManagerEmployee->firstname = 'David';
        $seoManagerEmployee->surname = 'Sheen';
        $seoManagerEmployee->lastname = 'Markovich';
        $seoManagerEmployee->date_of_birth = "1990-06-14";
        $seoManagerEmployee->department_id = $seoDepartment->id;
        $seoManagerEmployee->position_id = $seoManagerPosition->id;
        $seoManagerEmployee->salary_id = $seoManagerSalary->id;
        $seoManagerEmployee->employee_salary_id = $salary->id;
        $seoManagerEmployee->save();

        $seoManagerPosition = $seoDepartment->positions->where('title','SEO Employee')->first();
        $seoManagerSalary = $seoManagerPosition->salary->first();
        for ($i=1; $i<=10; $i++)
        {
            $salary = new EmployeeSalary();
            $salary->amount = '3000';
            $salary->salary_types_id = 2;
            $salary->save();

            $data[] = [
                'firstname' => 'John'.$i,
                'surname' => 'Doe'.$i,
                'lastname' => 'Emploeewitch',
                'date_of_birth' => "1982-06-14",
                'department_id' => $seoDepartment->id,
                'position_id' => $seoManagerPosition->id,
                'salary_id' => $seoManagerSalary->id,
                'employee_salary_id' => $salary->id,
            ];
        }

        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }
    }
}
