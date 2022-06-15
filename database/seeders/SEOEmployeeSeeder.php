<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
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
        $seoManagerPosition = $seoDepartment->positions->where('title','SEO Manager')->first();
        $seoManagerSalary = $seoManagerPosition->salary;

        $seoManagerEmployee = new Employee();
        $seoManagerEmployee->firstname = 'Liza';
        $seoManagerEmployee->surname = 'Simpson';
        $seoManagerEmployee->lastname = 'SEO wizard';
        $seoManagerEmployee->date_of_birth = "1990-06-14";
        $seoManagerEmployee->department_id = $seoDepartment->id;
        $seoManagerEmployee->position_id = $seoManagerPosition->id;
        $seoManagerEmployee->salary_id = $seoManagerSalary->id;
        $seoManagerEmployee->save();

        $seoManagerEmployee = new Employee();
        $seoManagerEmployee->firstname = 'David';
        $seoManagerEmployee->surname = 'Sheen';
        $seoManagerEmployee->lastname = 'Markovich';
        $seoManagerEmployee->date_of_birth = "1990-06-14";
        $seoManagerEmployee->department_id = $seoDepartment->id;
        $seoManagerEmployee->position_id = $seoManagerPosition->id;
        $seoManagerEmployee->salary_id = $seoManagerSalary->id;
        $seoManagerEmployee->save();

        $seoManagerPosition = $seoDepartment->positions->where('title','SEO Employee')->first();
        $seoManagerSalary = $seoManagerPosition->salary;
        for ($i=1; $i<=10; $i++)
        {
            $data[] = [
                'firstname' => 'John'.$i,
                'surname' => 'Doe'.$i,
                'lastname' => 'Emploeewitch',
                'date_of_birth' => "1982-06-14",
                'department_id' => $seoDepartment->id,
                'position_id' => $seoManagerPosition->id,
                'salary_id' => $seoManagerSalary->id,
            ];
        }

        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }
    }
}
