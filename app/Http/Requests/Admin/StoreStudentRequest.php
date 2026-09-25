<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:20', 'unique:students,nisn'],
            'school_name' => ['required', 'string', 'max:150'],
            'address' => ['required', 'string', 'max:1000'],
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'phone' => ['nullable', 'string', 'max:30'],
            'guardian_name' => ['required', 'string', 'max:150'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}
