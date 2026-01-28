<?php

namespace App\Http\Controllers;

use App\Services\DestinationService;
use Illuminate\View\View;

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
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|uuid|exists:destinations,id',
            'user_name' => 'required|string|max:255',
            'user_whatsapp' => 'required|string|max:20',
            'reservation_date' => 'required|date|after_or_equal:today',
            'number_of_people' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        try {
            $this->reservationService->createReservation($validated);

            return redirect()->back()->with('success', 'Reservasi berhasil dibuat! Silakan cek WhatsApp Anda untuk konfirmasi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat reservasi: ' . $e->getMessage())->withInput();
        }
    }
}
