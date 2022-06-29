<?php

namespace App\Services;

use App\Models\SalaryTypes;

class SalaryTypesService
{
    public function getSalaryTypes()
    {
        return SalaryTypes::all();
    }
}
