<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'destination_id' => 'required|uuid|exists:destinations,id',
            'user_name' => 'required|string|max:255',
            'user_whatsapp' => 'required|string|max:20|regex:/^[0-9\+\-\s\(\)]+$/',
            'reservation_date' => 'required|date|after_or_equal:today',
            'number_of_people' => 'required|integer|min:1',
            'needs' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_whatsapp.regex' => 'Format nomor WhatsApp tidak valid.',
            'destination_id.required' => 'Destinasi wajib diisi.',
            'destination_id.exists' => 'Destinasi yang dipilih tidak valid.',
            'user_name.required' => 'Nama wajib diisi.',
            'user_whatsapp.required' => 'WhatsApp wajib diisi.',
            'reservation_date.required' => 'Tanggal reservasi wajib diisi.',
            'number_of_people.required' => 'Jumlah orang wajib diisi.',
            'number_of_people.integer' => 'Jumlah orang harus berupa angka.',
            'number_of_people.min' => 'Jumlah orang minimal 1.',
            'needs.required' => 'Kebutuhan wajib diisi.',
            'destination_id.uuid' => 'Destinasi yang dipilih tidak valid.',
            'reservation_date.after_or_equal' => 'Tanggal reservasi harus hari ini atau setelahnya.',
            'user_whatsapp.max' => 'WhatsApp maksimal 20 karakter.',
            'needs.max' => 'Kebutuhan maksimal 255 karakter.',
            'notes.max' => 'Catatan maksimal 255 karakter.',
        ];
    }
}
