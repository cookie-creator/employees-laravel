<?php

namespace App\Adapters;

use App\Models\Department;
use App\Models\Employee;
use App\Models\SalaryTypes;
use Illuminate\Support\Facades\Storage;

class XMLFileAdapter
{
    public function index()
    {

    }

    public static function getXMLObjectFromFile($file)
    {
        $xml = simplexml_load_string(file_get_contents($file), "SimpleXMLElement", LIBXML_NOCDATA);
        return $xml;
    }

    public static function getXMLObjectFromStorage()
    {
        $rs = Storage::disk('local')->get('public/files/export.xml');
        $xml = simplexml_load_string($rs, "SimpleXMLElement", LIBXML_NOCDATA);
        return $xml;
    }

    public static function createXML()
    {
        $departments = Department::all();
        $salaryTypes = SalaryTypes::all();

        $xml = new \SimpleXMLElement('<xml/>');

        $xmlSalaryTypes = $xml->addChild('salary_types');
        foreach ($salaryTypes as $salaryType) {
            $xmlsalaryTypes = $xmlSalaryTypes->addChild('salary_type');
            $xmlsalaryTypes->addChild('id', $salaryType->id);
            $xmlsalaryTypes->addChild('title', $salaryType->title);
            $xmlsalaryTypes->addChild('type', $salaryType->type);
        }

        $xmlDepartments = $xml->addChild('departments');
        foreach ($departments as $department)
        {
            $xmlDepartment = $xmlDepartments->addChild('department');
            $xmlDepartment->addChild('id', $department->id);
            $xmlDepartment->addChild('title', $department->title);
            $xmlDepartment->addChild('description', $department->description);

            $xmlPositions = $xmlDepartment->addChild('positions');
            foreach ($department->positions as $position)
            {
                $xmlPosition = $xmlPositions->addChild('position');
                $xmlPosition->addChild('id', $position->id);
                $xmlPosition->addChild('title', $position->title);
                $xmlPosition->addChild('description', $position->description);
                $xmlPosition->addChild('department_id', $department->id);

                $xmlSalaries = $xmlPosition->addChild('salaries');
                foreach ($position->salary as $salary)
                {
                    $xmlSalary = $xmlSalaries->addChild('salary');
                    $xmlSalary->addChild('id', $salary->id);
                    $xmlSalary->addChild('title', $salary->title);
                    $xmlSalary->addChild('description', $salary->description);
                    $xmlSalary->addChild('position_id', $position->id);

                    $employees = Employee::where([
                        ['department_id', $department->id],
                        ['position_id', $position->id],
                        ['salary_id', $salary->id]
                    ])->get();

                    if ($employees->count() > 0)
                    {
                        $xmlEmployees = $xmlSalary->addChild('employees');

                        foreach ($employees as $employee)
                        {
                            $xmlEmployee = $xmlEmployees->addChild('employee');
                            $xmlEmployee->addChild('id', $employee->id);
                            $xmlEmployee->addChild('department_id', $employee->department_id);
                            $xmlEmployee->addChild('position_id', $employee->position_id);
                            $xmlEmployee->addChild('salary_id', $employee->salary_id);
                            $xmlEmployee->addChild('employee_salary_id', $employee->employee_salary_id);
                            $xmlEmployee->addChild('firstname', $employee->firstname);
                            $xmlEmployee->addChild('surname', $employee->surname);
                            $xmlEmployee->addChild('lastname', $employee->lastname);
                            $xmlEmployee->addChild('date_of_birth', $employee->date_of_birth);

                            $xmlSalary = $xmlEmployee->addChild('employee_salary');
                            $xmlSalary->addChild('id', $employee->employee_salary->id);
                            $xmlSalary->addChild('salary_types_id', $employee->employee_salary->salary_types_id);
                            $xmlSalary->addChild('amount', $employee->employee_salary->amount);
                        }
                    }
                }
            }
        }

        $rs = Storage::disk('local')->put('public/files/export.xml', $xml->asXML());
    }
}
