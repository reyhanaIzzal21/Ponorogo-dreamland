<?php

namespace App\Services;

use App\Contracts\Interfaces\ReservationRepositoryInterface;
use App\Models\Destination;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
            $destination = Destination::findOrFail($data['destination_id']);

            if (!$destination->isOpen()) {
                throw new Exception("Destination is not open for reservation.");
            }

            if (!empty($data['user_whatsapp'])) {
                $data['user_whatsapp'] = $this->formatPhoneIntl($data['user_whatsapp']);
            }

            $reservation = $this->reservationRepository->create($data);

            $this->sendWhatsAppNotification($reservation);

            return $reservation;
        });
    }

    /**
     * Format phone to international digits (Indonesia default)
     *
     * @param string $phone
     * @return string
     */
    private function formatPhoneIntl(string $phone): string
    {
        $p = preg_replace('/[^\d\+]/', '', $phone);

        if (str_starts_with($p, '+')) {
            $p = ltrim($p, '+');
        }

        if (str_starts_with($p, '0')) {
            $p = '62' . ltrim($p, '0');
        }

        if (preg_match('/^8\d{5,}$/', $p)) {
            $p = '62' . $p;
        }
        return $p;
    }

    /**
     * Send WhatsApp Notification
     *
     * @param Reservation $reservation
     * @return void
     */
    public function sendWhatsAppNotification(Reservation $reservation): void
    {
        $userMessage = "Halo {$reservation->user_name},\n\n";
        $userMessage .= "Terima kasih telah melakukan reservasi di *Ponorogo Dreamland*.\n\n";
        $userMessage .= "*Detail Reservasi*\n";
        $userMessage .= "ID: #" . substr($reservation->id, 0, 8) . "\n";
        $userMessage .= "• Destination : {$reservation->destination->name}\n";
        $userMessage .= "• Tanggal     : {$reservation->reservation_date->format('d F Y')}\n";
        $userMessage .= "• Jumlah Orang: {$reservation->number_of_people}\n";
        $userMessage .= "• Keperluan   : {$reservation->needs}\n";

        // Tambahkan notes bila ada
        if (!empty($reservation->notes)) {
            $userMessage .= "• Catatan     : {$reservation->notes}\n";
        }

        $userMessage .= "\nTim kami akan memproses dan mengonfirmasi reservasi ini dalam maksimal 1x24 jam kerja.\n";
        $userMessage .= "Jika ingin mengubah atau membatalkan reservasi, silakan balas pesan ini atau hubungi admin.\n\n";
        $userMessage .= "Salam,\nTim Ponorogo Dreamland";

        $response = $this->fonnteService->sendMessage($reservation->user_whatsapp, $userMessage);

        if ($response && is_array($response) && isset($response['status']) && $response['status'] == true) {
            $reservation->update([
                'wa_sent' => true,
                'wa_sent_at' => now(),
                'wa_error' => null
            ]);
            Log::info("WA sent successfully for reservation {$reservation->id}", ['response' => $response]);
        } else {
            $errorMsg = 'No response from provider';
            if (is_array($response)) {
                $errorMsg = json_encode($response);
            }
            $reservation->update([
                'wa_sent' => false,
                'wa_error' => $errorMsg
            ]);

            Log::error("Failed to send WA for reservation {$reservation->id}", ['response' => $response]);
        }
    }
}
