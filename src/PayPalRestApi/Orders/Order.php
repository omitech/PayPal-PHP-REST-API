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
    public function create(OrderData $data): array
    {
        return $this->client->request('POST', '/v2/checkout/orders', $data->toPayPalFormat());
    }

    // Method to capture the order
    public function capture(string $orderId): array|null
    {
        $response = $this->client->request('POST', "/v2/checkout/orders/{$orderId}/capture");

        if ($response['status'] == 'COMPLETED') {
            return $response; // Return the successful capture response
        } else {
            return null; // Handle failure cases
        }        
    }
}
