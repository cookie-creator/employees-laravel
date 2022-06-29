<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    private DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(Request $request)
    {
        $onpage = ($request->onpage > 0) ? $request->onpage : 10;

        $employees = Employee::where('department_id', $request->department_id)
            ->orderBy('department_id', 'asc')
            ->orderBy('firstname', 'asc')
            ->paginate($onpage, ['*'], 'page');

        $employees->appends(['onpage' => $onpage]);
        $departments = $this->departmentService->getDeparments();
        $selectedDepartment = $request->department_id;

        return view('pages.employees')
            ->with($employees)
            ->with($departments)
            ->with($selectedDepartment)
            ->with($onpage);
    }

    public function list()
    {
        $departments = $this->departmentService->getDeparments();

        return view('pages.departments', compact(['departments']));
    }

    public function edit(Request $request)
    {
        $department = $this->departmentService->getDepartment($request->department_id);

        $canDelete = !(($department->positions->count() > 0 || Employee::where('department_id', $department->id)->first()));

        return view('pages.department-edit', compact(['department', 'canDelete']));
    }

    public function update(UpdateDepartmentRequest $request)
    {
        $department = $this->departmentService->getDepartment($request->department_id);

        $department->update($request->validated());

        return redirect()->route('department.edit', ['department_id' => $department->id]);
    }

    public function create()
    {
        return view('pages.department-create');
    }

    public function store(CreateDepartmentRequest $request)
    {
        $request->validated();

        $department = new Department();
        $department->title = $request['title'];
        $department->description = $request['description'];
        $department->save();

        return redirect()->route('department.edit', ['department_id' => $department->id]);
    }

    public function destroy(Request $request)
    {
        $this->departmentService->destroyDepartment($request->department_id);

        return redirect()->route('departments');
    }
}
