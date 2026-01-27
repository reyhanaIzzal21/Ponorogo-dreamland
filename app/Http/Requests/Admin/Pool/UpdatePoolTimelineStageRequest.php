<?php

namespace App\Http\Requests\Admin\Pool;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePoolTimelineStageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'period' => 'nullable|string|max:255',
            'status' => 'required|in:planned,on_progress,done',
            'progress_percentage' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'period.max' => 'Periode maksimal 255 karakter.',
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status harus salah satu dari: planned, on_progress, done.',
            'progress_percentage.required' => 'Persentase progres wajib diisi.',
            'progress_percentage.integer' => 'Persentase progres harus berupa angka.',
            'progress_percentage.min' => 'Persentase progres minimal 0%.',
            'progress_percentage.max' => 'Persentase progres maksimal 100%.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ];
    }
}
