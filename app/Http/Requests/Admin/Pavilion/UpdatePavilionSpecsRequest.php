<?php

namespace App\Http\Requests\Admin\Pavilion;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePavilionSpecsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'specs_items' => 'nullable|array|max:4',
            'specs_items.*.title' => 'required|string|max:100',
            'specs_items.*.value' => 'required|string|max:100',
            'specs_items.*.subtitle' => 'nullable|string|max:100',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'specs_items.max' => 'Maksimal 4 item spesifikasi.',
            'specs_items.*.title.required' => 'Judul spesifikasi wajib diisi.',
            'specs_items.*.value.required' => 'Nilai spesifikasi wajib diisi.',
        ];
    }
}
