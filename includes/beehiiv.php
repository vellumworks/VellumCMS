<?php

require_once __DIR__ . '/../config/config.php';

/**
 * Subscribe an email address to the beehiiv publication.
 * Returns true on success, false on failure.
 */
function beehiiv_subscribe(string $email, array $custom_fields = []): bool {
    if (!BEEHIIV_API_KEY || !BEEHIIV_PUBLICATION_ID) {
        return false;
    }

    $payload = [
        'email'               => $email,
        'reactivate_existing' => true,
        'send_welcome_email'  => true,
    ];

    if (!empty($custom_fields)) {
        $payload['custom_fields'] = $custom_fields;
    }

    $ch = curl_init(sprintf(
        'https://api.beehiiv.com/v2/publications/%s/subscriptions',
        BEEHIIV_PUBLICATION_ID
    ));

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . BEEHIIV_API_KEY,
        ],
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_TIMEOUT        => 10,
    ]);

    $response = curl_exec($ch);
    $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $status === 200 || $status === 201;
}
