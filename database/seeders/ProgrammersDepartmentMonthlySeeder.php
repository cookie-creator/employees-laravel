<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammersDepartmentMonthlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = new Department();
        $department->title = 'Programmers';
        $department->description = 'Programmers Department';
        $department->save();

        // Team lead
        $teamLead = new Position();
        $teamLead->title = 'Team lead';
        $teamLead->description = 'Team lead';
        $department->positions()->save($teamLead);

        $teamLeadSalary = new Salary();
        $teamLeadSalary->title = 'Team Lead Salary';
        $teamLeadSalary->amount = '5000';
        $teamLeadSalary->salary_types_id = 2;
        $teamLead->salary()->save($teamLeadSalary);

        // Senior
        $senior = new Position();
        $senior->title = 'Senior dev';
        $senior->description = 'Senior dev';
        $department->positions()->save($senior);

        $seniorSalary = new Salary();
        $seniorSalary->title = 'Senior Salary';
        $seniorSalary->amount = '3000';
        $seniorSalary->salary_types_id = 2;
        $senior->salary()->save($seniorSalary);

        // Middle
        $middle = new Position();
        $middle->title = 'Middle dev';
        $middle->description = 'Middle dev';
        $department->positions()->save($middle);

        $middleSalary = new Salary();
        $middleSalary->title = 'Middle Salary';
        $middleSalary->amount = '2000';
        $middleSalary->salary_types_id = 2;
        $middle->salary()->save($middleSalary);

        // Junior
        $junior = new Position();
        $junior->title = 'Junior dev';
        $junior->description = 'Junior dev';
        $department->positions()->save($junior);

        $juniorSalary = new Salary();
        $juniorSalary->title = 'Junior Salary';
        $juniorSalary->amount = '1000';
        $juniorSalary->salary_types_id = 2;
        $junior->salary()->save($juniorSalary);
    }
}
