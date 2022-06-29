<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\CreateSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __construct()
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
        $positions = Position::all();

        $canDelete = (Employee::where('salary_id',$salary->id)->first() !== null)
            ? false : true;

        return view('pages.salary-edit', compact(['salary', 'departments', 'positions', 'canDelete']));
    }

    public function update(UpdateSalaryRequest $request)
    {
        $request->validated();

        $salary = Salary::find($request->salary_id);

        $salary->title = $request['title'];
        $salary->description = $request['description'];

        if (Employee::where('salary_id',$salary->id)->first() === null)
            $salary->position_id = $request['position'];

        $salary->save();

        return redirect()->route('salary.edit', ['salary_id' => $salary->id]);
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();

        return view('pages.salary-create', compact(['departments','positions']));
    }
    public function store(CreateSalaryRequest $request)
    {
        $request->validated();

        $salary = new Salary();

        $salary->title = $request['title'];
        $salary->description = $request['description'];
        $salary->position_id = $request['position'];
        $salary->save();

        return redirect()->route('salary.edit', ['salary_id' => $salary->id]);
    }

    public function destroy(Request $request)
    {
        Salary::find($request->salary_id)->delete();

        return redirect()->route('salaries');
    }
}
