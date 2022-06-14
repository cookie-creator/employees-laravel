<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __contruct()
    {

    }

    public function index()
    {
        return view('pages.positions');
    }
}
