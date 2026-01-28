<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function getContact()
    {
        return Contact::firstOrCreate([], [
            'whatsapp_number' => '628123456789',
            'instagram_url' => 'https://instagram.com/ponorogo.dreamland',
            'tiktok_url' => 'https://tiktok.com/@ponorogo.dreamland',
            'address' => 'Jl. Raya Ponorogo No. 123, Kecamatan Kota, Ponorogo, Jawa Timur, Indonesia',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=...',
        ]);
    }

    public function updateContact(array $data)
    {
        $contact = $this->getContact();
        $contact->update($data);
        return $contact;
    }
}
