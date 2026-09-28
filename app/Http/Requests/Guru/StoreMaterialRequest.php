<?php

namespace App\Http\Requests\Guru;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()?->role === 'teacher';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:100'],
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:2000'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,ppt,pptx', 'max:10240'],
            'status' => ['required', 'in:draft,published'],
        ];
    }
}
