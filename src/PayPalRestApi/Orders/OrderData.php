<?php

namespace PayPalRestApi\Orders;

class OrderData
{
    float string $amount;
    private string $currency;
    private string $description;
    private string $returnUrl;
    private string $cancelUrl;

    // Constructor to initialize order data
    public function __construct(
        float $amount,
        string $currency,
        string $description,
        string $returnUrl,
        string $cancelUrl
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->returnUrl = $returnUrl;
        $this->cancelUrl = $cancelUrl;
    }

    // Getters for order data
    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    public function getCancelUrl(): string
    {
        return $this->cancelUrl;
    }

    // Convert order data to the format required by PayPal
    public function toPayPalFormat(): array
    {
        return [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => $this->getCurrency(),
                        'value' => $this->getAmount()
                    ],
                    'description' => $this->getDescription()
                ]
            ],
            'application_context' => [
                'return_url' => $this->getReturnUrl(),
                'cancel_url' => $this->getCancelUrl()
            ]
        ];
    }
}
