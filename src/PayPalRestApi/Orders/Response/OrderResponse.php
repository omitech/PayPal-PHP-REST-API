<?php

namespace PayPalRestApi\Orders\Response;

class OrderResponse
{
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_CREATED = 'CREATED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_VOIDED = 'VOIDED';
    const STATUS_PAYER_ACTION_REQUIRED = 'PAYER_ACTION_REQUIRED';
    
    private string $id;
    private string $status;
    private ?string $payerEmail;
    private ?string $payerId;
    private float $purchaseAmount;
    private string $currency;
    private ?string $customId;
    private ?string $paymentId; 

    // Constructor to initialize the response data
    public function __construct(array $response)
    {
        $this->id = $response['id'] ?? '';
        $this->status = $response['status'] ?? '';
        
        // Extract payer 
        $this->payerEmail = $response['payer']['email_address'];
        $this->payerId = $response['payer']['payer_id'];

        // Extracting the purchase amount and currency
        $this->purchaseAmount = (float) ($response['purchase_units'][0]['payments']['captures'][0]['amount']['value'] ?? 0);
        $this->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'] ?? 'XXX';
        
        // Extract custom ID
        $this->customId = $response['purchase_units'][0]['payments']['captures'][0]['custom_id'];

        // Extract payment ID
        $this->paymentId = $response['purchase_units'][0]['payments']['captures'][0]['id'] ?? null;
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
        ];
    }
}

