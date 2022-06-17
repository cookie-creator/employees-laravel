<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\Position;
use App\Models\Salary;
use App\Models\SalaryTypes;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function __contruct()
    {

    }

    public function index(Request $request)
    {
        $onpage = ($request->onpage > 0) ? $request->onpage : 10;

        $employees = Employee::
            orderBy('department_id', 'asc')
            ->orderBy('firstname', 'asc')
            ->paginate($perPage = $onpage, $columns = ['*'], $pageName = 'page');

        $departments = Department::all();

        $employees->appends(['onpage' => $onpage]);

        return view('pages.employees', compact(['employees', 'departments', 'onpage']));
    }

    public function edit(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        $departments = Department::all();
        $positions = Position::all();
        $salaries = Salary::all();
        $salaryTypes = SalaryTypes::all();

        return view('pages.employee', compact(['employee', 'departments', 'positions', 'salaries', 'salaryTypes']));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $salaries = Salary::all();
        $salaryTypes = SalaryTypes::all();

        return view('pages.employee-create', compact(['departments', 'positions', 'salaries', 'salaryTypes']));
    }

    public function update(UpdateEmployeeRequest $request)
    {
        $request->validated();

        $employee = Employee::find($request->employee_id);

        $employee->firstname = $request['firstname'];
        $employee->surname = $request['surname'];
        $employee->lastname = $request['lastname'];
        $employee->date_of_birth = $request['year'] . '-' . $request['month'] . '-' . $request['day'];

        $employee->department_id = $request['department'];
        $employee->position_id = $request['position'];
        $employee->salary_id = $request['salary'];

        $employee->employee_salary->amount = $request['salaryAmount'];
        $employee->employee_salary->salary_types_id = $request['salaryType'];
        $employee->employee_salary->save();

        $employee->save();

        return redirect()->route('employee.edit', ['employee_id' => $employee->id]);
    }


    public function store(CreateEmployeeRequest $request)
    {
        $request->validated();

        $employeeSalary = new EmployeeSalary();
        $employeeSalary->amount = $request['salaryAmount'];
        $employeeSalary->salary_types_id = $request['salaryType'];
        $employeeSalary->save();

        $employee = new Employee();
        $employee->firstname = $request['firstname'];
        $employee->surname = $request['surname'];
        $employee->lastname = $request['lastname'];
        $employee->date_of_birth = $request['year'] . '-' . $request['month'] . '-' . $request['day'];

        $employee->department_id = $request['department'];
        $employee->position_id = $request['position'];
        $employee->salary_id = $request['salary'];
        $employee->employee_salary_id = $employeeSalary->id;
        $employee->save();

        return redirect()->route('employee.edit', ['employee_id' => $employee->id]);
    }

    public function destroy(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        $id = $employee->employee_salary_id;
        $employee->delete();
        EmployeeSalary::find($id)->delete();

        return redirect()->route('employees');
    }
}
