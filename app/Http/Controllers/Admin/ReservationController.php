<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Interfaces\ReservationRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\ReservationService;
use App\Models\Reservation;
use App\Models\Destination;

class ReservationController extends Controller
{
    public function __construct(
        protected ReservationRepositoryInterface $reservationRepository,
        protected ReservationService $reservationService
    ) {}

    public function index(Request $request): mixed
    {
        $filters = $request->only(['search', 'date', 'type', 'status']);
        $perPage = 10;
        $reservations = $this->reservationRepository->getFiltered($filters, $perPage);

        $waFailedCount = Reservation::where('wa_sent', false)->count();

        // ambil daftar destination untuk dropdown filter
        $destinations = Destination::orderBy('name')->get();

        if ($request->ajax()) {
            $tableHtml = view('admin.pages.reservations.partials.table', compact('reservations'))->render();
            $paginationHtml = (string) $reservations->links();
            return response()->json([
                'table' => $tableHtml,
                'pagination' => $paginationHtml,
            ]);
        }

        return view('admin.pages.reservations.index', compact('reservations', 'waFailedCount', 'destinations'));
    }

    public function show($id): View
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.pages.reservations.show', compact('reservation'));
    }

    public function resendWhatsApp($id)
    {
        $reservation = Reservation::findOrFail($id);

        try {
            $this->reservationService->sendWhatsAppNotification($reservation);

            // refresh model instance
            $reservation = $reservation->fresh();

            if ($reservation->wa_sent) {
                return redirect()->back()->with('success', 'Notifikasi WhatsApp berhasil dikirim ulang.');
            } else {
                return redirect()->back()->with('error', 'Gagal mengirim WhatsApp: ' . $reservation->wa_error);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $this->reservationRepository->update($id, ['status' => $request->status]);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        $filters = $request->only(['search', 'date', 'type', 'status']);
        $reservations = $this->reservationRepository->getFilteredForExport($filters);

        $filename = "reservations-" . date('Y-m-d-H-i') . ".csv";

        // Streamed response (lebih aman daripada echo+exit)
        $columns = ['ID', 'Destination', 'Name', 'WhatsApp', 'Date', 'People', 'Notes', 'Created At'];

        return response()->streamDownload(function () use ($reservations, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($reservations as $reservation) {
                fputcsv($handle, [
                    $reservation->id,
                    optional($reservation->destination)->name,
                    $reservation->user_name,
                    $reservation->user_whatsapp,
                    $reservation->reservation_date->format('Y-m-d'),
                    $reservation->number_of_people,
                    $reservation->notes,
                    $reservation->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
