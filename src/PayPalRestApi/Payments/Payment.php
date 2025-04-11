<?php

namespace PayPalRestApi\Payments;

use PayPalRestApi\Core\PayPalClient;
use PayPalRestApi\Payments\Response\PaymentResponse;

class Payment
{
    private PayPalClient $client;

    public function __construct(PayPalClient $client)
    {
        $this->client = $client;
    }

    // Method to get payment details (authorized payment)
    public function get(string $paymentId): PaymentResponse
    {
        $response = $this->client->request('GET', "/v2/checkout/payments/{$paymentId}");

        return new PaymentResponse($response);
    }      
    
    // extend with other methods if nessessary
}
