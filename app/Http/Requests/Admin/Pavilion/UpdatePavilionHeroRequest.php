<?php

namespace App\Http\Requests\Admin\Pavilion;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePavilionHeroRequest extends FormRequest
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
            'highlighted_title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
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
            'title.max' => 'Judul utama maksimal 255 karakter.',
            'highlighted_title.max' => 'Judul kuning maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
            'background_image.image' => 'File harus berupa gambar.',
            'background_image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'background_image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
