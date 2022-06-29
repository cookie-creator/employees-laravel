<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function getDepartment($idDepartment)
    {
        return Department::find($idDepartment);
    }

    public function getDeparments()
    {
        return Department::all();
    }

    public function destroyDepartment($idDepartment)
    {
        Department::find($idDepartment)->delete();
    }
}
