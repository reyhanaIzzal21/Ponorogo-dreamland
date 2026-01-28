<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Interfaces\ReservationRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\ReservationService;
use App\Models\Reservation;
use App\Models\Destination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationExport;

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
            $paginationHtml = (string) $reservations->appends($filters)->links();
            return response()->json([
                'table' => $tableHtml,
                'pagination' => $paginationHtml,
                'total' => $reservations->total(), // optional: supaya frontend bisa update counter
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
        $timestamp = date('Y-m-d-H-i');
        $xlsxFilename = "reservations-{$timestamp}.xlsx";

        // Jika package maatwebsite/excel tersedia => pakai XLSX dengan styling yang bagus
        if (class_exists(\Maatwebsite\Excel\Excel::class)) {
            // resolve repository agar export class bisa menggunakannya
            $repo = app(ReservationRepositoryInterface::class);
            return Excel::download(new ReservationExport($filters, $repo), $xlsxFilename);
        }

        // Fallback: CSV yang diformat rapi (Excel-friendly, include BOM)
        $reservations = $this->reservationRepository->getFilteredForExport($filters);
        $csvFilename = "reservations-{$timestamp}.csv";
        $columns = ['Name', 'Destination', 'WhatsApp', 'Reservation Date', 'People', 'Needs', 'Notes'];

        return response()->streamDownload(function () use ($reservations, $columns) {
            $handle = fopen('php://output', 'w');

            // Write UTF-8 BOM so Excel opens CSV with correct encoding
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header
            fputcsv($handle, $columns);

            foreach ($reservations as $r) {
                fputcsv($handle, [
                    $r->user_name,
                    optional($r->destination)->name,
                    $r->user_whatsapp,
                    $r->reservation_date ? $r->reservation_date->format('Y-m-d') : '',
                    $r->number_of_people,
                    $r->needs,
                    $r->notes,
                ]);
            }

            fclose($handle);
        }, $csvFilename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$csvFilename}\"",
        ]);
    }
}
