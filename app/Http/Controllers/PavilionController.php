<?php

namespace App\Http\Controllers;

use App\Services\PavilionPageService;
use Illuminate\View\View;

class PavilionController extends Controller
{
    public function __construct(
        protected PavilionPageService $pavilionService
    ) {}

    /**
     * Display the pavilion page.
     */
    public function index(): View
    {
        $data = $this->pavilionService->getPageData();

        return view('user.pages.destinations.pavilion.index', [
            'heroSection' => $data['hero'],
            'specsSection' => $data['specs'],
            'facilitiesSection' => $data['facilitiesSection'],
            'facilities' => $data['facilities'],
            'layouts' => $data['layouts'],
        ]);
    }
}
