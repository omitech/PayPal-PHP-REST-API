<?php

namespace PayPalRestApi\Orders;

use PayPalRestApi\Core\PayPalClient;
use PayPalRestApi\Orders\Response\OrderResponse;

class Order
{
    private PayPalClient $client;

    public function __construct(PayPalClient $client)
    {
        $this->client = $client;
    }

    // Method to create the order
    public function create(OrderData $data): OrderResponse
    {
        $response = $this->client->request('POST', '/v2/checkout/orders', $data->toPayPalFormat());

        return new OrderResponse($response);   
    }

    // Method to capture the order
    public function capture(string $orderId): OrderResponse
    {
        $response = $this->client->request('POST', "/v2/checkout/orders/{$orderId}/capture");

        return new OrderResponse($response);       
    }
}
