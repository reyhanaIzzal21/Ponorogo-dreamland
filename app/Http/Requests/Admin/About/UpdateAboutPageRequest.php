<?php

namespace App\Http\Requests\Admin\About;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutPageRequest extends FormRequest
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
            // Hero
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_blob_image' => 'nullable|image|max:2048', // 2MB Max

            // Story 1
            'story_1_title' => 'nullable|string|max:255',
            'story_1_description' => 'nullable|string',
            'story_1_image' => 'nullable|image|max:2048',

            // Story 2
            'story_2_title' => 'nullable|string|max:255',
            'story_2_description' => 'nullable|string',
            'story_2_image' => 'nullable|image|max:2048',

            // Story 3
            'story_3_title' => 'nullable|string|max:255',
            'story_3_description' => 'nullable|string',
            'story_3_image' => 'nullable|image|max:2048',

            // Values
            'value_1_title' => 'nullable|string|max:255',
            'value_1_description' => 'nullable|string',
            'value_2_title' => 'nullable|string|max:255',
            'value_2_description' => 'nullable|string',
            'value_3_title' => 'nullable|string|max:255',
            'value_3_description' => 'nullable|string',

            // Stats
            'stat_1_label' => 'nullable|string|max:255',
            'stat_1_value' => 'nullable|string|max:255',
            'stat_2_label' => 'nullable|string|max:255',
            'stat_2_value' => 'nullable|string|max:255',
            'stat_3_label' => 'nullable|string|max:255',
            'stat_3_value' => 'nullable|string|max:255',

            // Founder
            'founder_quote' => 'nullable|string',
            'founder_job' => 'nullable|string|max:255',
            'founder_sub_job' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            // with indonesian massage
            'hero_title.required' => 'Judul Hero wajib diisi',
            'hero_subtitle.required' => 'Subjudul Hero wajib diisi',
            'hero_blob_image.required' => 'Gambar Blob Hero wajib diisi',
            'story_1_title.required' => 'Judul Cerita 1 wajib diisi',
            'story_1_description.required' => 'Deskripsi Cerita 1 wajib diisi',
            'story_1_image.required' => 'Gambar Cerita 1 wajib diisi',
            'story_2_title.required' => 'Judul Cerita 2 wajib diisi',
            'story_2_description.required' => 'Deskripsi Cerita 2 wajib diisi',
            'story_2_image.required' => 'Gambar Cerita 2 wajib diisi',
            'story_3_title.required' => 'Judul Cerita 3 wajib diisi',
            'story_3_description.required' => 'Deskripsi Cerita 3 wajib diisi',
            'story_3_image.required' => 'Gambar Cerita 3 wajib diisi',
            'value_1_title.required' => 'Judul Nilai 1 wajib diisi',
            'value_1_description.required' => 'Deskripsi Nilai 1 wajib diisi',
            'value_2_title.required' => 'Judul Nilai 2 wajib diisi',
            'value_2_description.required' => 'Deskripsi Nilai 2 wajib diisi',
            'value_3_title.required' => 'Judul Nilai 3 wajib diisi',
            'value_3_description.required' => 'Deskripsi Nilai 3 wajib diisi',
            'stat_1_label.required' => 'Label Stat 1 wajib diisi',
            'stat_1_value.required' => 'Nilai Stat 1 wajib diisi',
            'stat_2_label.required' => 'Label Stat 2 wajib diisi',
            'stat_2_value.required' => 'Nilai Stat 2 wajib diisi',
            'stat_3_label.required' => 'Label Stat 3 wajib diisi',
            'stat_3_value.required' => 'Nilai Stat 3 wajib diisi',
            'founder_quote.required' => 'Kutipan Pendiri wajib diisi',
            'founder_job.required' => 'Pekerjaan Pendiri wajib diisi',
            'founder_sub_job.required' => 'Sub Pekerjaan Pendiri wajib diisi',
        ];
    }
}
