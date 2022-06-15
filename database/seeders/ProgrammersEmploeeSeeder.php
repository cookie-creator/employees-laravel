<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammersEmploeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Team lead 10
        $department = Department::where('title', 'Programmers')->first();
        $position = $department->positions->where('title','Team lead')->first();
        $salary = $position->salary;

        for ($i=1; $i<=10; $i++)
        {
            $data[] = [
                'firstname' => 'Antony'.$i,
                'surname' => 'Starr'.$i,
                'lastname' => 'Homelander'.$i,
                'date_of_birth' => "1982-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
            ];
        }

        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }

        // senior dev monthly
        $position = $department->positions->where('title','Senior dev')->first();
        $salary = $position->salary;
        for ($i=1; $i<=50; $i++)
        {
            $data[] = [
                'firstname' => 'Lazaro'.$i,
                'surname' => 'Alonso'.$i,
                'lastname' => 'Milk'.$i,
                'date_of_birth' => "1974-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }

        // senior dev per hour
        $position = $department->positions->where('title','Senior dev per hour')->first();
        $salary = $position->salary;
        for ($i=1; $i<=50; $i++)
        {
            $data[] = [
                'firstname' => 'Tomer'.$i,
                'surname' => 'Capone'.$i,
                'lastname' => 'Frenchie'.$i,
                'date_of_birth' => "1985-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }

        // middle monthly
        $position = $department->positions->where('title','Middle dev')->first();
        $salary = $position->salary;
        for ($i=1; $i<=100; $i++)
        {
            $data[] = [
                'firstname' => 'Jack'.$i,
                'surname' => 'Quaid'.$i,
                'lastname' => 'Hughie'.$i,
                'date_of_birth' => "1982-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }

        // middle per hour
        $position = $department->positions->where('title','Middle dev per hour')->first();
        $salary = $position->salary;
        for ($i=1; $i<=100; $i++)
        {
            $data[] = [
                'firstname' => 'Jensen'.$i,
                'surname' => 'Ackles'.$i,
                'lastname' => 'Dean'.$i,
                'date_of_birth' => "1978-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }

        // Junior monthly
        $position = $department->positions->where('title','Junior dev')->first();
        $salary = $position->salary;
        for ($i=1; $i<=400; $i++)
        {
            $data[] = [
                'firstname' => 'Simon'.$i,
                'surname' => 'John'.$i,
                'lastname' => 'Pegg'.$i,
                'date_of_birth' => "1970-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }

        // Junior per hour
        $position = $department->positions->where('title','Junior dev per hour')->first();
        $salary = $position->salary;
        for ($i=1; $i<=400; $i++)
        {
            $data[] = [
                'firstname' => 'Nick'.$i,
                'surname' => 'Frost'.$i,
                'lastname' => 'Clive'.$i,
                'date_of_birth' => "1978-06-14",
                'department_id' => $department->id,
                'position_id' => $position->id,
                'salary_id' => $salary->id,
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach($chunks as $chunk)
        {
            Employee::insert($chunk);
        }
    }
}
