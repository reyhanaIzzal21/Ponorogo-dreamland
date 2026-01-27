<?php

namespace App\Http\Requests\Admin\Pool;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePoolSneakPeekRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function massages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.max' => 'Deskripsi maksimal 255 karakter.',
            'image.required' => 'Gambar wajib diisi.',
            'image.image' => 'Gambar harus berupa gambar.',
            'image.max' => 'Gambar maksimal 2MB.',
        ];
    }
}
