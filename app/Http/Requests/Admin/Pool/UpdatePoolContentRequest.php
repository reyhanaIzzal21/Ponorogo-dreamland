<?php

namespace App\Http\Requests\Admin\Pool;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePoolContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'badge_text' => 'nullable|string|max:255',
            'main_headline' => 'nullable|string|max:255',
            'blue_headline' => 'nullable|string|max:255',
            'sub_headline' => 'nullable|string',
            'launch_date' => 'nullable|date',
            'teaser_background' => 'nullable|image|max:2048', 
        ];
    }

    public function messages(): array
    {
        return [
            'badge_text.required' => 'Badge wajib diisi.',
            'badge_text.max' => 'Badge maksimal 255 karakter.',
            'main_headline.required' => 'Headline utama wajib diisi.',
            'main_headline.max' => 'Headline utama maksimal 255 karakter.',
            'blue_headline.required' => 'Headline biru wajib diisi.',
            'blue_headline.max' => 'Headline biru maksimal 255 karakter.',
            'sub_headline.required' => 'Sub headline wajib diisi.',
            'sub_headline.max' => 'Sub headline maksimal 255 karakter.',
            'launch_date.required' => 'Tanggal peluncuran wajib diisi.',
            'launch_date.date' => 'Tanggal peluncuran harus berupa tanggal.',
            'teaser_background.required' => 'Gambar teaser wajib diisi.',
            'teaser_background.image' => 'Gambar teaser harus berupa gambar.',
            'teaser_background.max' => 'Gambar teaser maksimal 2MB.',
        ];
    }
}
