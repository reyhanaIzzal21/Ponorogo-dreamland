<?php

namespace App\Http\Requests;

use App\Models\Destination;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDestinationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'type' => ['required', Rule::in(array_keys(Destination::getTypes()))],
            'status' => ['required', Rule::in(array_keys(Destination::getStatuses()))],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama destinasi wajib diisi.',
            'name.max' => 'Nama destinasi maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
            'type.required' => 'Tipe bisnis wajib dipilih.',
            'type.in' => 'Tipe bisnis tidak valid.',
            'status.required' => 'Status operasional wajib dipilih.',
            'status.in' => 'Status operasional tidak valid.',
            'cover_image.image' => 'File harus berupa gambar.',
            'cover_image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'cover_image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
