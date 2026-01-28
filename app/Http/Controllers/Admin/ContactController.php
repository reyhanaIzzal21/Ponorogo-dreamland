<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Interfaces\ContactRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index()
    {
        $contact = $this->contactRepository->getContact();
        return view('admin.pages.contacts.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'whatsapp_number' => 'required|string|max:50',
            'instagram_url' => 'required|url',
            'tiktok_url' => 'required|url',
            'address' => 'required|string',
            'maps_embed_url' => 'required|string',
        ]);

        $this->contactRepository->updateContact($data);

        return redirect()->back()->with('success', 'Contact information updated successfully.');
    }
}
