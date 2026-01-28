<?php

namespace App\Services;

use App\Contracts\Interfaces\ReservationRepositoryInterface;
use App\Models\Destination;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Exception;

class ReservationService
{
    public function __construct(
        protected ReservationRepositoryInterface $reservationRepository,
        protected FonnteService $fonnteService
    ) {}

    /**
     * Create a new reservation
     *
     * @param array $data
     * @return Reservation
     * @throws Exception
     */
    public function createReservation(array $data): Reservation
    {
        return DB::transaction(function () use ($data) {
            // Validate Destination Status
            $destination = Destination::findOrFail($data['destination_id']);

            if (!$destination->isOpen()) {
                throw new Exception("Destination is not open for reservation.");
            }

            // Create Reservation
            $reservation = $this->reservationRepository->create($data);

            // Send WhatsApp Notification
            $this->sendWhatsAppNotification($reservation);

            return $reservation;
        });
    }

    /**
     * Send WhatsApp Notification
     *
     * @param Reservation $reservation
     * @return void
     */
    protected function sendWhatsAppNotification(Reservation $reservation): void
    {
        $adminPhone = '088991162533'; // Default admin phone as per request
        // Ideally this should be in config, but hardcoded per user example for now.
        // Or we can use the user's phone for confirmation and admin's phone for alert.

        // User Notification
        $userMessage = "Halo {$reservation->user_name},\n\nTerima kasih telah melakukan reservasi di Ponorogo Dreamland.\n\nDetail Reservasi:\nDestination: {$reservation->destination->name}\nTanggal: {$reservation->reservation_date->format('d F Y')}\nJumlah Orang: {$reservation->number_of_people}\nStatus: PENDING\n\nMohon tunggu konfirmasi selanjutnya dari admin kami.";

        $this->fonnteService->sendMessage($reservation->user_whatsapp, $userMessage);

        // We can also notify admin here if needed, but user requirement specifically mentioned 
        // "sistem akan mengirim pesan otomatis dari no admin ... ke nomor user yang melakukan reservasi"
    }
}
