<?php

namespace App\Services;

use App\Contracts\ImportServiceInterface;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\Position;
use App\Models\Salary;
use App\Models\SalaryTypes;

class ImportService implements ImportServiceInterface
{
    public function __construct()
    {

    }

    public function startImport($xmlObject)
    {
        try {
            $this->importSalaryTypes($xmlObject->salary_types);
            $this->importDepartments($xmlObject->departments);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @param array $departments
     */
    public function importSalaryTypes($salary_types)
    {
        foreach ($salary_types->salary_type as $types) {
            SalaryTypes::insertOrIgnore([
                ['id' => (string)$types->id, 'title' => (string)$types->title, 'type' => (string)$types->type],
            ]);
        }
    }

    /**
     * @param array $departments
     */
    public function importDepartments($departments)
    {
        foreach ($departments->department as $department) {
            $newDepartment = new Department();
            $newDepartment->title = (string)$department->title;
            $newDepartment->description = (string)$department->description;
            $newDepartment->save();

            if ($department->positions->position !== null) {
                foreach ($department->positions->position as $position) {
                    $newPosition = new Position();
                    $newPosition->title = (string)$position->title;
                    $newPosition->description = (string)$position->description;
                    $newPosition->department_id = $newDepartment->id;
                    $newPosition->save();

                    if ($position->salaries->salary !== null) {
                        foreach ($position->salaries->salary as $salary) {
                            $newSalary = new Salary();
                            $newSalary->title = (string)$salary->title;
                            $newSalary->description = (string)$salary->description;;
                            $newSalary->position_id = $newPosition->id;
                            $newSalary->save();

                            if ($salary->employees->employee !== null) {
                                foreach ($salary->employees->employee as $employee) {
                                    $employeeSalary = new EmployeeSalary();
                                    $employeeSalary->amount = (string)$employee->employee_salary->amount;
                                    $employeeSalary->salary_types_id = (string)$employee->employee_salary->salary_types_id;
                                    $employeeSalary->save();

                                    $newEmployee = new Employee();
                                    $newEmployee->department_id = $newDepartment->id;
                                    $newEmployee->position_id = $newPosition->id;
                                    $newEmployee->salary_id = $newSalary->id;
                                    $newEmployee->firstname = (string)$employee->firstname;
                                    $newEmployee->surname = (string)$employee->surname;
                                    $newEmployee->lastname = (string)$employee->lastname;
                                    $newEmployee->date_of_birth = (string)$employee->date_of_birth;
                                    $newEmployee->employee_salary_id = $employeeSalary->id;
                                    $newEmployee->save();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
