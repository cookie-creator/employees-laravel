<?php

namespace App\Services;

use App\Models\Salary;

class SalariesService
{
    public function getSalaries()
    {
        return Salary::all();
    }
}
