<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\CreatePostionRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpdatePostionRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __contruct()
    {

    }

    public function index()
    {
        $positions = Position::all();

        return view('pages.positions', compact(['positions']));
    }

    public function edit(Request $request)
    {
        $position = Position::find($request->position_id);
        $departments = Department::all();

        $canDelete = ($position->salary !== null || Employee::where('position_id',$position->id)->first() !== null)
            ? false : true;

        return view('pages.position-edit', compact(['position', 'departments', 'canDelete']));
    }

    public function update(UpdatePostionRequest $request)
    {
        $request->validated();

        $position = Position::find($request->position_id);
        $department = Department::find($request['department']);
        $position->title = $request['title'];
        $position->description = $request['description'];

        $department->positions()->save($position);

        return redirect()->route('position.edit', ['position_id' => $position->id]);
    }

    public function create()
    {
        $departments = Department::all();

        return view('pages.position-create', compact(['departments']));
    }

    public function store(CreatePostionRequest $request)
    {
        $request->validated();

        $position = new Position();
        $department = Department::find($request['department']);

        $position->title = $request['title'];
        $position->description = $request['description'];

        $department->positions()->save($position);

        return redirect()->route('position.edit', ['position_id' => $position->id]);
    }

    public function destroy(Request $request)
    {
        Position::find($request->position_id)->delete();

        return redirect()->route('positions');
    }
}
