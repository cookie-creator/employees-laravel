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
        $posts = EmployesController::latest()
            ->paginate($perPage = 30, $columns = ['*'], $pageName = 'posts');
        return view('pages.employes');
    }
}
