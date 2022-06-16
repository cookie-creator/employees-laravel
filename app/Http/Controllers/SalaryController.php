<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __contruct()
    {

    }

    public function index()
    {
        $salaries = Salary::all();

        return view('pages.salaries', compact(['salaries']));
    }

    public function edit(Request $request)
    {
        $salary = Salary::find($request->salary_id);

        $departments = Department::all();

        $canDelete = (Employee::where('salary_id',$salary->id)->first() !== null)
            ? false : true;

        return view('pages.salary-edit', compact(['salary', 'departments', 'canDelete']));
    }

    public function update(UpdateSalaryRequest $request)
    {

    }

    public function create()
    {

    }
    public function store(CreateEmployeeRequest $request)
    {

    }

    public function destroy(Request $request)
    {
        Salary::find($request->salary_id)->delete();

        return redirect()->route('salaries');
    }
}
