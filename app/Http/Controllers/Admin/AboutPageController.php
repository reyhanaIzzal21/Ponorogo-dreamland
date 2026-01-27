<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Interfaces\AboutPageRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\About\UpdateAboutPageRequest;

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
        return view('admin.pages.about.index', compact('about'));
    }

    public function update(UpdateAboutPageRequest $request)
    {
        $this->aboutRepository->updateContent($request->validated());

        return redirect()->back()->with('success', 'Konten About Page berhasil diperbarui.');
    }
}
