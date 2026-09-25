<?php

namespace App\Http\Requests\Maintenance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LandingContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'type' => ['required', 'in:program,package,hero,stat,section,benefit,cta,footer,brand'],
            'badge' => ['nullable', 'string', 'max:80'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'meta' => ['nullable', 'string', 'max:150'],
            'price' => ['nullable', 'string', 'max:80'],
            'price_suffix' => ['nullable', 'string', 'max:30'],
            'features' => ['nullable', 'string', 'max:500'],
            'cta_label' => ['nullable', 'string', 'max:80'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:999'],
        ];
    }
}
