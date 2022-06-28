<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' => 'required|string|min:2|max:255',
            'surname' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'department' => 'required|exists:departments,id',
            'position' => 'required|exists:positions,id',
            'salary' => 'required|exists:salaries,id',
            'salaryType' => 'required|exists:salary_types,id',
            'salaryAmount' => 'required',
        ];
    }
}
