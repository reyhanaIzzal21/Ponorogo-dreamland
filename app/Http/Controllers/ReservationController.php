<?php

namespace App\Http\Controllers;

use App\Services\DestinationService;
use Illuminate\View\View;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;


class ReservationController extends Controller
{
    public function __construct(
        protected DestinationService $destinationService,
        protected \App\Services\ReservationService $reservationService
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

    /**
     * Store a new reservation.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReservationRequest $request)
    {
        $validated = $request->validated();

        try {
            $reservation = $this->reservationService->createReservation($validated);

            return redirect()->route('reservation.finish', $reservation->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat reservasi: ' . $e->getMessage())->withInput();
        }
    }

    public function finish($id): View
    {
        $reservation = Reservation::findOrFail($id);
        return view('user.pages.reservations.finish', compact('reservation'));
    }
}
