<?php

namespace App\Http\Controllers;

use App\Services\RestaurantPageService;
use App\Models\MenuItem;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function __construct(
        protected RestaurantPageService $restaurantService
    ) {}

    /**
     * Display the restaurant page.
     */
    public function index(): View
    {
        $data = $this->restaurantService->getPageData();

        // Get 4 random menu items for "Jelajahi Rasa" section
        $randomMenus = MenuItem::active()->inRandomOrder()->limit(4)->get();

        return view('user.pages.destinations.restaurant.index', [
            'heroSection' => $data['hero'],
            'filosofiSection' => $data['filosofi'],
            'bestSellers' => $data['bestSellers'],
            'galleryImages' => $data['gallery'],
            'randomMenus' => $randomMenus,
        ]);
    }
}
