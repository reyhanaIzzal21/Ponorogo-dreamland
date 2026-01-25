<?php

namespace App\Http\Controllers;

use App\Services\DestinationService;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function __construct(
        protected DestinationService $destinationService
    ) {}

    /**
     * Display the reservations page with destinations.
     *
     * @return View
     */
    public function index(): View
    {
        $destinations = $this->destinationService->getActiveDestinations();

        return view('user.pages.reservations.index', [
            'destinations' => $destinations,
        ]);
    }
}
