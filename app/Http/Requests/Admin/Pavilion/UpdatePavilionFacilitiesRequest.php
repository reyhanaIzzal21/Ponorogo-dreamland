<?php

namespace App\Http\Requests\Admin\Pavilion;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePavilionFacilitiesRequest extends FormRequest
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
            'section_title' => 'nullable|string|max:255',
            'section_description' => 'nullable|string|max:1000',
            'facilities' => 'nullable|array',
            'facilities.*.icon' => 'required|string|max:10',
            'facilities.*.title' => 'required|string|max:100',
            'facilities.*.description' => 'nullable|string|max:255',
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
            'section_title.max' => 'Judul section maksimal 255 karakter.',
            'section_description.max' => 'Deskripsi section maksimal 1000 karakter.',
            'facilities.*.icon.required' => 'Icon fasilitas wajib diisi.',
            'facilities.*.title.required' => 'Nama fasilitas wajib diisi.',
        ];
    }
}
