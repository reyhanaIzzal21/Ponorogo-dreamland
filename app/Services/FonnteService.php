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
                'Authorization' => $this->token,
            ])->post("{$this->baseUrl}/send", [
                'target' => $target,
                'message' => $message,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Fonnte API Error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Fonnte Service Error: ' . $e->getMessage());
            return null;
        }
    }
}
