<?php

namespace App\Http\Controllers;

use App\Services\DestinationService;
use App\Services\LandingPageService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected DestinationService $destinationService,
        protected LandingPageService $landingPageService
    ) {}

    /**
     * Display the home page with destinations and landing page content.
     *
     * @return View
     */
    public function index(): View
    {
        $destinations = $this->destinationService->getActiveDestinations();

        // Get landing page sections
        $heroSection = $this->landingPageService->getHeroSection();
        $aboutSection = $this->landingPageService->getAboutSection();
        $whySection = $this->landingPageService->getWhyChooseUsSection();
        $momentSection = $this->landingPageService->getMomentSection();

        return view('user.pages.home', [
            'destinations' => $destinations,
            'heroSection' => $heroSection,
            'aboutSection' => $aboutSection,
            'whySection' => $whySection,
            'momentSection' => $momentSection,
        ]);
    }
}
