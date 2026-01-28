<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\ContactRepositoryInterface;
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
        return view('user.pages.contact', compact('contact'));
    }
}
