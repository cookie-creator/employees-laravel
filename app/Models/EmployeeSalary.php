<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $table = 'employee_salaries';

    protected $fillable = [
        'amount',
        'salary_types_id',
    ];

    public function employee()
    {
        return $this->haveOne(Employee::class);
    }

    public function salary_types()
    {
        return $this->belongsTo(SalaryTypes::class);
    }
}
