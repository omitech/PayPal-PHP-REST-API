<?php

namespace PayPalRestApi\Payments\Response;

class CaptureResponse
{
    private string $id;
    private string $status;
    private bool $finalCapture;

    private float $amount;
    private string $currency;
    private string $captureDate;

    private ?string $orderId;
    private ?string $transactionId;

    // Constructor to initialize the response data
    public function __construct(array $response)
    {
        $this->id = $response['id'] ?? '';
        $this->status = $response['status'] ?? '';
        
        $this->finalCapture = $response['final_capture'] ?? false;

        // Extract capture amount and currency
        $this->amount = (float) ($response['amount']['value'] ?? 0);
        $this->currency = $response['amount']['currency_code'] ?? 'XXX';
        
        // Extract the capture date
        $this->captureDate = $response['create_time'] ?? '';

        // Extract the supplementary_data (if available)
        $relatedIds = $response['supplementary_data']['related_ids'] ?? [];
        $this->orderId = $relatedIds['order_id'] ?? null;
        $this->transactionId = $relatedIds['authorization_id'] ?? null;
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

    public function isFinalCapture(): bool
    {
        return $this->finalCapture;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getCaptureDate(): string
    {
        return $this->captureDate;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    // Method to return parsed details as an associative array
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'final_capture' => $this->isFinalCapture(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'capture_date' => $this->getCaptureDate(),
            'order_id' => $this->getOrderId(),
            'transaction_id' => $this->getTransactionId(),
        ];
    }
}
