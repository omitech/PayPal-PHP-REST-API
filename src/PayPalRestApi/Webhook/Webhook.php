<?php

namespace PayPalRestApi\Webhook;

use PayPalRestApi\Core\PayPalClient;
use PayPalRestApi\Core\ApiException;

class Webhook
{
    private PayPalClient $client;
    private string $webhookId;

    public function __construct(PayPalClient $client, string $webhookId)
    {
        $this->client = $client;
        $this->webhookId = $webhookId;
    }

    /**
     * Verifies a PayPal webhook.
     *
     * @param array $headers Incoming HTTP headers
     * @param string $body Raw request body (JSON)
     * @return bool
     */
    public function verify(array $headers, string $body): bool
    {
        $data = [
            'auth_algo'         => $headers['paypal-auth-algo'] ?? '',
            'cert_url'          => $headers['paypal-cert-url'] ?? '',
            'transmission_id'   => $headers['paypal-transmission-id'] ?? '',
            'transmission_sig'  => $headers['paypal-transmission-sig'] ?? '',
            'transmission_time' => $headers['paypal-transmission-time'] ?? '',
            'webhook_id'        => $this->webhookId,
            'webhook_event'     => json_decode($body, true),
        ];

        try {
            $response = $this->client->request('POST', '/v1/notifications/verify-webhook-signature', $data);
            return isset($response['verification_status']) && $response['verification_status'] === 'SUCCESS';
        } catch (ApiException $e) {
            return false;
        }
    }

    /**
     * Creates a new PayPal webhook.
     *
     * @param string $url The callback URL to receive events
     * @param array $eventTypes Array of event types to subscribe to
     * @return array|null Returns the created webhook data or null on failure
     */
    public function create(string $url, array $eventTypes): ?array
    {
        $data = [
            'url' => $url,
            'event_types' => array_map(fn($type) => ['name' => $type], $eventTypes),
        ];

        return $this->client->request('POST', '/v1/notifications/webhooks', $data);
    }

    /**
     * Parse the webhook payload.
     *
     * @param string $body Raw JSON body
     * @return array Decoded payload
     */
    public function parse(string $body): array
    {
        return json_decode($body, true);
    }
}
