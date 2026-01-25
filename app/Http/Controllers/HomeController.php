<?php

namespace App\Http\Controllers;

use App\Services\DestinationService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected DestinationService $destinationService
    ) {}

    /**
     * Display the home page with destinations.
     *
     * @return View
     */
    public function index(): View
    {
        $destinations = $this->destinationService->getActiveDestinations();

        return view('user.pages.home', [
            'destinations' => $destinations,
        ]);
    }
}
