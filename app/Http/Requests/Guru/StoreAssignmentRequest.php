<?php

namespace App\Http\Requests\Guru;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()?->role === 'teacher' && Auth::user()->teacher !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'title' => ['required', 'string', 'max:255'],
            'instructions' => ['required', 'string', 'max:5000'],
            'points' => ['required', 'integer', 'min:1', 'max:1000'],
            'due_at' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published'],
        ];
    }
}
