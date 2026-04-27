<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CharityCommissionService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.charity_commission.url'), '/');
    }

    /**
     * Look up a charity by its registration number.
     * Returns the charity data array on success, null if not found or API unavailable.
     */
    public function lookup(string $charityNumber): ?array
    {
        try {
            $response = Http::timeout(8)
                ->get("{$this->baseUrl}/charityregister/{$charityNumber}");

            if ($response->successful()) {
                return $response->json();
            }

            if ($response->status() === 404) {
                return null; // number not found
            }

            Log::warning('Charity Commission API unexpected response', [
                'status'         => $response->status(),
                'charity_number' => $charityNumber,
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Charity Commission API unavailable', [
                'error'          => $e->getMessage(),
                'charity_number' => $charityNumber,
            ]);

            return null;
        }
    }

    /**
     * Verify a charity number is currently registered and active.
     * Returns true only if the API confirms the charity exists and is active.
     * On API failure we return false and let the registration fall through to manual review.
     */
    public function verify(string $charityNumber): bool
    {
        $data = $this->lookup($charityNumber);

        if ($data === null) {
            return false;
        }

        // The API returns "Registered" for active charities
        $status = $data['registrationStatus'] ?? $data['status'] ?? '';

        return strtolower($status) === 'registered';
    }
}
