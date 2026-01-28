<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Interfaces\ReservationRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function __construct(
        protected ReservationRepositoryInterface $reservationRepository
    ) {}

    public function index(Request $request): View
    {
        $query = $request->input('search');
        $date = $request->input('date');

        if ($query) {
            $reservations = $this->reservationRepository->search($query);
        } elseif ($date) {
            $reservations = $this->reservationRepository->filterByDate($date);
        } else {
            $reservations = $this->reservationRepository->paginate(10);
        }

        return view('admin.pages.reservations.index', compact('reservations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $this->reservationRepository->update($id, ['status' => $request->status]);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    // Basic Excel Export Implementation (can be enhanced with Maatwebsite/Excel if available, 
    // but using simple CSV/HTML table download method for now to avoid dependency issues if not installed)
    public function export()
    {
        $reservations = $this->reservationRepository->all();

        $filename = "reservations-" . date('Y-m-d') . ".csv";

        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fputcsv($handle, ['ID', 'Destination', 'Name', 'WhatsApp', 'Date', 'People', 'Notes', 'Status', 'Created At']);

        foreach ($reservations as $reservation) {
            fputcsv($handle, [
                $reservation->id,
                $reservation->destination->name,
                $reservation->user_name,
                $reservation->user_whatsapp,
                $reservation->reservation_date->format('Y-m-d'),
                $reservation->number_of_people,
                $reservation->notes,
                $reservation->status,
                $reservation->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($handle);
        exit;
    }
}
