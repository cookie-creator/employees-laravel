<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammersDepartmentPerHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = Department::where('title','Programmers')->first();

        // Senior
        $senior = new Position();
        $senior->title = 'Senior dev per hour';
        $senior->description = 'Senior dev per hour';
        $department->positions()->save($senior);

        $seniorSalary = new Salary();
        $seniorSalary->title = 'Senior dev per hour Salary';
        $seniorSalary->amount = '300';
        $seniorSalary->salary_types_id = 1;
        $senior->salary()->save($seniorSalary);

        // Middle
        $middle = new Position();
        $middle->title = 'Middle dev per hour';
        $middle->description = 'Middle dev per hour ';
        $department->positions()->save($middle);

        $middleSalary = new Salary();
        $middleSalary->title = 'Middle per hour Salary';
        $middleSalary->amount = '200';
        $middleSalary->salary_types_id = 1;
        $middle->salary()->save($middleSalary);

        // Junior
        $junior = new Position();
        $junior->title = 'Junior dev per hour';
        $junior->description = 'Junior dev per hour';
        $department->positions()->save($junior);

        $juniorSalary = new Salary();
        $juniorSalary->title = 'Junior per hour Salary';
        $juniorSalary->amount = '100';
        $juniorSalary->salary_types_id = 1;
        $junior->salary()->save($juniorSalary);
    }
}
