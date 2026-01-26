<?php

namespace App\Http\Requests\Admin\Pavilion;

use Illuminate\Foundation\Http\FormRequest;

class SaveAllPavilionRequest extends FormRequest
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
            // Hero Section
            'hero.title' => 'nullable|string|max:255',
            'hero.highlighted_title' => 'nullable|string|max:255',
            'hero.description' => 'nullable|string|max:1000',

            // Specs Section
            'specs.title' => 'nullable|string|max:255',
            'specs.subtitle' => 'nullable|string|max:255',
            'specs.items' => 'nullable|array|max:4',
            'specs.items.*.title' => 'required|string|max:100',
            'specs.items.*.desc' => 'required|string|max:100',

            // Facilities Section
            'facilities.title' => 'nullable|string|max:255',
            'facilities.description' => 'nullable|string|max:1000',
            'facilities.items' => 'nullable|array',
            'facilities.items.*.icon' => 'required|string|max:10',
            'facilities.items.*.title' => 'required|string|max:100',
            'facilities.items.*.desc' => 'nullable|string|max:255',

            // Layouts
            'layouts' => 'nullable|array',
            'layouts.*.id' => 'required|string',
            'layouts.*.title' => 'required|string|max:100',
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
            'hero.title.max' => 'Judul hero maksimal 255 karakter.',
            'hero.highlighted_title.max' => 'Judul kuning maksimal 255 karakter.',
            'hero.description.max' => 'Deskripsi hero maksimal 1000 karakter.',
            'specs.items.max' => 'Maksimal 4 item spesifikasi.',
            'specs.items.*.title.required' => 'Judul spesifikasi wajib diisi.',
            'specs.items.*.desc.required' => 'Nilai spesifikasi wajib diisi.',
            'facilities.items.*.icon.required' => 'Icon fasilitas wajib diisi.',
            'facilities.items.*.title.required' => 'Nama fasilitas wajib diisi.',
            'layouts.*.id.required' => 'ID layout wajib diisi.',
            'layouts.*.title.required' => 'Nama layout wajib diisi.',
        ];
    }
}
