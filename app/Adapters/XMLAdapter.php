<?php

namespace App\Adapters;

use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;
use App\Models\SalaryTypes;
use Illuminate\Support\Facades\Storage;

class XMLAdapter
{
    public function index()
    {

    }

    public function createXML()
    {
        $departments = Department::all();
        //$positions = Position::all();
        //$salaries = Salary::all();
        //$salaryTypes = SalaryTypes::all();

        $xml = new \SimpleXMLElement('<xml/>');

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


                dump($position->salary);

                /*$xmlSalaries = $xmlPosition->addChild('salaries');
                foreach ($position->salary as $salary)
                {
                    $xmlSalary = $xmlSalaries->addChild('salary');
                    $xmlSalary->addChild('id', $salary->id);
                    $xmlSalary->addChild('title', $salary->title);
                    $xmlSalary->addChild('amount', $salary->amount);
                    $xmlSalary->addChild('position_id', $position->id);
                    $xmlSalary->addChild('salary_types_id', $salary->salary_types->id);
                }*/
            }
        }




        $rs = Storage::disk('local')->put('public/files/simple.xml', $xml->asXML());
    }
}
