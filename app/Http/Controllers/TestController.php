<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        //$seoDepartment = Department::where('title', 'SEO')->first();
        //$seoManagerPosition = $seoDepartment->positions->where('title','SEO Manager')->first();
        //$seoManagerSalary = $seoManagerPosition->salary;


        $department = Department::where('title', 'QA')->first();
        $position = $department->positions->where('title','QA Employee per hour')->first();

        dump($department->positions);
    }
}
