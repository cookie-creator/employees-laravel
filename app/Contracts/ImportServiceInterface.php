<?php

namespace App\Contracts;

interface ImportServiceInterface
{
    public function startImport($xmlArray);
    public function importSalaryTypes($salary_types);
    public function importDepartments($departments);
    public function importEmployees($employees);
}
