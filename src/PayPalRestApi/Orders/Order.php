<?php

namespace PayPalRestApi\Orders;

use PayPalRestApi\Core\PayPalClient;

class Order
{
    private PayPalClient $client;

    public function __construct(PayPalClient $client)
    {
        $this->client = $client;
    }

    // Method to create the order
    public function create(OrderData $data): string|void
    {
        $response = $this->client->request('POST', '/v2/checkout/orders', $data->toPayPalFormat());

        // Find the approval URL from the response
        foreach ($data['links'] as $link) {
            if ($link['rel'] == 'approve') {
                return $link->href; // Return the approval URL
            }
        }

        return null;
    }

    // Method to capture the order
    public function capture(string $orderId): array|void
    {
        $response = $this->client->request('POST', "/v2/checkout/orders/{$orderId}/capture");

        if ($data['status'] == 'COMPLETED') {
            return $data; // Return the successful capture response
        } else {
            return null; // Handle failure cases
        }        
    }
}
