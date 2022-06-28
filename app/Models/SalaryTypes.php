<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryTypes extends Model
{
    use HasFactory;

    /**
     * @param type 0 : per hour, 1 : monthly
     */
    protected $fillable = [
        'title',
        'type'
    ];

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

}
