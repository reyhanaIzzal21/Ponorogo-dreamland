<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::firstOrCreate([], [
            'whatsapp_number' => '628123456789',
            'instagram_url' => 'https://instagram.com/ponorogo.dreamland',
            'tiktok_url' => 'https://tiktok.com/@ponorogo.dreamland',
            'address' => 'Jl. Raya Ponorogo No. 123, Kecamatan Kota, Ponorogo, Jawa Timur, Indonesia',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3327.7251369098735!2d111.4760320941322!3d-7.855125738801359!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a1ded1a0dbdb%3A0x9690e837420f5ce3!2sPonorogo%20Dreamland!5e1!3m2!1sid!2sid!4v1769495204339!5m2!1sid!2sid',
        ]);
    }
}
