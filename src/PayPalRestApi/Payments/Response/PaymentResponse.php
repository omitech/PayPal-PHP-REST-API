<?php

namespace PayPalRestApi\Payments\Response;

class PaymentResponse
{
    private string $id;
    private string $status;
    private ?string $payerEmail;
    private ?string $payerId;
    private float $purchaseAmount;
    private string $currency;
    private ?string $customId;
    private ?string $paymentId;
    private ?string $authorizationId;
    private ?string $authorizationState;
    private ?string $authorizationDate;

    // Constructor to initialize the response data
    public function __construct(array $response)
    {
        $this->id = $response['id'] ?? '';
        $this->status = $response['status'] ?? '';
        
        // Extract payer details
        $this->payerEmail = $response['payer']['email_address'] ?? null;
        $this->payerId = $response['payer']['payer_id'] ?? null;

        // Extracting the purchase amount and currency
        $this->purchaseAmount = (float) ($response['purchase_units'][0]['amount']['value'] ?? 0);
        $this->currency = $response['purchase_units'][0]['amount']['currency_code'] ?? 'XXX';

        // Extract custom ID if available
        $this->customId = $response['purchase_units'][0]['payments']['captures'][0]['custom_id'] ?? null;

        // Extract payment ID from captures or authorizations
        $this->paymentId = $response['purchase_units'][0]['payments']['captures'][0]['id'] ?? $response['purchase_units'][0]['payments']['authorizations'][0]['id'] ?? null;

        // Extract authorization details if available
        $this->authorizationId = $response['purchase_units'][0]['payments']['authorizations'][0]['id'] ?? null;
        $this->authorizationState = $response['purchase_units'][0]['payments']['authorizations'][0]['state'] ?? null;
        $this->authorizationDate = $response['purchase_units'][0]['payments']['authorizations'][0]['create_time'] ?? null;
    }

    // Getter methods for each field
    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPayerEmail(): ?string
    {
        return $this->payerEmail;
    }
    
    public function getPayerId(): ?string
    {
        return $this->payerId; 
    }

    public function getPurchaseAmount(): float
    {
        return $this->purchaseAmount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getCustomId(): ?string
    {
        return $this->customId;
    }

    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    public function getAuthorizationId(): ?string
    {
        return $this->authorizationId;
    }

    public function getAuthorizationState(): ?string
    {
        return $this->authorizationState;
    }

    public function getAuthorizationDate(): ?string
    {
        return $this->authorizationDate;
    }

    // Method to return parsed details as an associative array
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'payer_email' => $this->getPayerEmail(),
            'payer_id' => $this->getPayerId(),
            'purchase_amount' => $this->getPurchaseAmount(),
            'currency' => $this->getCurrency(),
            'custom_id' => $this->getCustomId(),
            'payment_id' => $this->getPaymentId(),
            'authorization_id' => $this->getAuthorizationId(),
            'authorization_state' => $this->getAuthorizationState(),
            'authorization_date' => $this->getAuthorizationDate(),
        ];
    }
}
