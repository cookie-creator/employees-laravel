<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employes";

    protected $fillable = [
        'firstname',
        'surname',
        'lastname',
        'date_of_birth',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::createFromFormat('Y-m-d', $this->date_of_birth)->format('d')
        );
    }

    protected function month(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::createFromFormat('Y-m-d', $this->date_of_birth)->format('m')
        );
    }

    protected function year(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::createFromFormat('Y-m-d', $this->date_of_birth)->format('Y')
        );
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::createFromFormat('Y-m-d', $this->date_of_birth)->toFormattedDateString()
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->firstname . ' ' . $this->surname . ' ' . $this->lastname
        );
    }
}
