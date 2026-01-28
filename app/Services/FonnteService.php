<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected string $baseUrl = 'https://api.fonnte.com';
    protected string $token;

    public function __construct()
    {
        $this->token = config('fonnte.token');
    }

    /**
     * Validate token / get device profile
     *
     * @return array|null
     */
    public function getDeviceProfile(): ?array
    {
        try {
            // Note: Fonnte docs use Authorization: TOKEN (no Bearer)
            $response = Http::withHeaders([
                'Authorization' => $this->token,
                'Accept' => 'application/json',
            ])->post("{$this->baseUrl}/device");

            if ($response->ok()) {
                return $response->json();
            }

            Log::error('Fonnte device API Error: ' . $response->body());
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Fonnte getDeviceProfile Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Send WhatsApp message
     *
     * @param string $target Target phone number
     * @param string $message Message content
     * @return array|null Response from Fonnte or null on failure
     */
    public function sendMessage(string $target, string $message): ?array
    {
        try {
            $response = Http::withHeaders([
                // IMPORTANT: use token only, per Fonnte docs.
                'Authorization' => $this->token,
                'Accept' => 'application/json',
            ])->post("{$this->baseUrl}/send", [
                'target' => $target,
                'message' => $message,
            ]);

            // Always return JSON when API responds (even jika status=false)
            if ($response->successful() || $response->status() === 200) {
                return $response->json();
            }

            // non-200
            Log::error('Fonnte API Error (non-200): ' . $response->status() . ' - ' . $response->body());
            return [
                'status' => false,
                'reason' => 'non-200 response: ' . $response->status(),
                'body' => $response->body()
            ];
        } catch (\Exception $e) {
            Log::error('Fonnte Service Error: ' . $e->getMessage());
            return [
                'status' => false,
                'reason' => 'exception: ' . $e->getMessage()
            ];
        }
    }
}
