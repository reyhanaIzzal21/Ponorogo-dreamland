<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AboutPageRepositoryInterface;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    protected $aboutRepository;

    public function __construct(AboutPageRepositoryInterface $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    public function index()
    {
        $about = $this->aboutRepository->getContent();
        return view('user.pages.about', compact('about'));
    }
}
