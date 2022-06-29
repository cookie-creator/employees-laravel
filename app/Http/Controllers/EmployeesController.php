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
use App\Services\DepartmentService;
use App\Services\PositionsService;
use App\Services\SalariesService;
use App\Services\SalaryTypesService;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    private DepartmentService $departmentService;
    private PositionsService $positionsService;
    private SalariesService $salariesService;
    private SalaryTypesService $salaryTypesService;

    public function __construct(DepartmentService $departmentService,
                                PositionsService $positionsService,
                                SalariesService $salariesService,
                                SalaryTypesService $salaryTypesService)
    {
        $this->departmentService = $departmentService;
        $this->positionsService = $positionsService;
        $this->salariesService = $salariesService;
        $this->salaryTypesService = $salaryTypesService;
    }

    public function index(Request $request)
    {
        $onpage = ($request->onpage > 0) ? $request->onpage : 10;

        $employees = Employee::orderBy('department_id', 'asc')
            ->orderBy('firstname', 'asc')
            ->paginate($onpage, ['*'], 'page');

        $departments = $this->departmentService->getDeparments();

        $employees->appends(['onpage' => $onpage]);

        return view('pages.employees')
            ->with($employees)
            ->with($departments)
            ->with($onpage);
    }

    public function edit(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        $departments = $this->departmentService->getDeparments();
        $positions = $this->positionsService->getPositions();
        $salaries = $this->salariesService->getSalaries();
        $salaryTypes = $this->salaryTypesService->getSalaryTypes();

        return view('pages.employee')
            ->with($employee)
            ->with($departments)
            ->with($positions)
            ->with($salaries)
            ->with($salaryTypes);
    }

    public function create()
    {
        $departments = $this->departmentService->getDeparments();
        $positions = $this->positionsService->getPositions();
        $salaries = $this->salariesService->getSalaries();
        $salaryTypes = $this->salaryTypesService->getSalaryTypes();

        return view('pages.employee-create')
            ->with($departments)
            ->with($positions)
            ->with($salaries)
            ->with($salaryTypes);
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
