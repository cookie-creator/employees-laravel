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

    private $departmentId, $positionId, $salaryId, $employeeSalaryId;

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

            $this->departmentId = $newDepartment->id;

            if ($department->positions->position !== null) {
                $this->importPositions($department->positions->position);
            }
        }
    }

    private function importPositions($positions)
    {
        foreach ($positions as $position) {
            $newPosition = new Position();
            $newPosition->title = (string)$position->title;
            $newPosition->description = (string)$position->description;
            $newPosition->department_id = $this->departmentId;
            $newPosition->save();

            $this->positionId = $newPosition->id;

            if ($position->salaries->salary !== null) {
                $this->importSalaries($position->salaries->salary);
            }
        }
    }

    private function importSalaries($salaries)
    {
        foreach ($salaries as $salary) {
            $newSalary = new Salary();
            $newSalary->title = (string)$salary->title;
            $newSalary->description = (string)$salary->description;;
            $newSalary->position_id = $this->positionId;
            $newSalary->save();

            $this->salaryId = $newSalary->id;

            if ($salary->employees->employee !== null) {
                $this->importEmployees($salary->employees->employee);
            }
        }
    }

    private function importEmployees($employees)
    {
        foreach ($employees as $employee) {
            $employeeSalary = new EmployeeSalary();
            $employeeSalary->amount = (string)$employee->employee_salary->amount;
            $employeeSalary->salary_types_id = (string)$employee->employee_salary->salary_types_id;
            $employeeSalary->save();

            $this->employeeSalaryId = $employeeSalary->id;

            $this->importEmployee($employee);
        }
    }

    private function importEmployee($employee)
    {
        $newEmployee = new Employee();
        $newEmployee->department_id = $this->departmentId;
        $newEmployee->position_id = $this->positionId;
        $newEmployee->salary_id = $this->salaryId;
        $newEmployee->firstname = (string)$employee->firstname;
        $newEmployee->surname = (string)$employee->surname;
        $newEmployee->lastname = (string)$employee->lastname;
        $newEmployee->date_of_birth = (string)$employee->date_of_birth;
        $newEmployee->employee_salary_id = $this->employeeSalaryId;
        $newEmployee->save();
    }
}
