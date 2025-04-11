<?php

namespace PayPalRestApi\Payments;

use PayPalRestApi\Core\PayPalClient;
use PayPalRestApi\Payments\Response\PaymentResponse;
use PayPalRestApi\Payments\Response\CaptureResponse;

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
        $response = $this->client->request('GET', "/v2/payments/authorizations/{$paymentId}");

        return new PaymentResponse($response);
    }      
    
    // Method to get capture details
    public function captureDetails(string $captureId): CaptureResponse
    {
        $response = $this->client->request('GET', "/v2/payments/captures/{$captureId}");

        return new CaptureResponse($response);
    }

    // Method to refund the capture
    public function refund(string $captureId, ?string $message = null): CaptureResponse
    {
        if (!empty($message)) {
            $body = ['note_to_payer' => $message];
        } else {
            $body = null;
        }

        $response = $this->client->request('POST', "/v2/payments/captures/{$captureId}/refund", $body);

        return new CaptureResponse($response);       
    }

    // extend with other methods if nessessary
}
