<?php

namespace App\Http\Requests\Admin\Pavilion;

use Illuminate\Foundation\Http\FormRequest;

class StorePavilionFacilityRequest extends FormRequest
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
            'icon' => 'required|string|max:10',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
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
            'icon.required' => 'Icon wajib diisi.',
            'title.required' => 'Nama fasilitas wajib diisi.',
            'title.max' => 'Nama fasilitas maksimal 100 karakter.',
            'description.max' => 'Deskripsi maksimal 255 karakter.',
        ];
    }
}
