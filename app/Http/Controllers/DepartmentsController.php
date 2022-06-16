<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function __contruct()
    {

    }

    public function index(Request $request)
    {
        $onpage = ($request->onpage > 0) ? $request->onpage : 10;

        $employees = Employee::where('department_id', $request->department_id)
            ->orderBy('department_id', 'asc')
            ->orderBy('firstname', 'asc')
            //->cursorPaginate(15);
            ->paginate($perPage = $onpage, $columns = ['*'], $pageName = 'page');

        $employees->appends(['onpage' => $onpage]);

        $departments = Department::all();
        $selectedDepartment = $request->department_id;

        return view('pages.employees', compact(['employees', 'departments', 'selectedDepartment', 'onpage']));
    }

    public function list(Request $request)
    {
        $departments = Department::all();

        return view('pages.departments', compact(['departments']));
    }

    public function edit(Request $request)
    {
        $department = Department::find($request->department_id);

        $canDelete = ($department->positions->count() > 0 || Employee::where('department_id',$department->id)->first() !== null)
            ? false : true;

        return view('pages.department-edit', compact(['department', 'canDelete']));
    }

    public function update(UpdateDepartmentRequest $request)
    {
        $request->validated();

        $department = Department::find($request->department_id);

        $department->title = $request['title'];
        $department->description = $request['description'];
        $department->save();

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
        Department::find($request->department_id)->delete();

        return redirect()->route('departments');
    }
}
