<?php

namespace App\Http\Controllers;

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
}
