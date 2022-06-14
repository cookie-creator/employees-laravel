<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployesController extends Controller
{
    public function __contruct()
    {

    }

    public function index()
    {
        return view('pages.employes');
    }
}
